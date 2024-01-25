<?php

namespace App\Entity;

use App\Repository\BlogpostsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlogpostsRepository::class)]
class Blogposts
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $blogtitle = null;

    #[ORM\Column(length: 2000, nullable: true)]
    private ?string $blogtext = null;

    #[ORM\ManyToOne(inversedBy: 'blogposts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $user_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBlogtitle(): ?string
    {
        return $this->blogtitle;
    }

    public function setBlogtitle(string $blogtitle): static
    {
        $this->blogtitle = $blogtitle;

        return $this;
    }

    public function getBlogtext(): ?string
    {
        return $this->blogtext;
    }

    public function setBlogtext(?string $blogtext): static
    {
        $this->blogtext = $blogtext;

        return $this;
    }

    public function getUserId(): ?Users
    {
        return $this->user_id;
    }

    public function setUserId(?Users $user_id): static
    {
        $this->user_id = $user_id;

        return $this;
    }
}
