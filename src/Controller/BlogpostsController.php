<?php

namespace App\Controller;

use App\Entity\Blogposts;
use App\Entity\Users;
use App\Form\BlogpostsFormType;
use App\Repository\BlogpostsRepository;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogpostsController extends AbstractController
{
    private $blogpostsRepository;
    public function __construct(BlogpostsRepository $blogpostsRepository)
    {
        $this->blogpostsRepository = $blogpostsRepository;
    }

    #[Route('/blogposts/create', name: 'app_blogposts_create')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $blogposts = new Blogposts();

        $form = $this->createForm(BlogpostsFormType::class, $blogposts);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($blogposts);
            $entityManager->flush();
        }

        return $this->render('blogposts/blogposts.html.twig', [
            'blogpostsForm' => $form->createView(),
        ]);
    }

    #[Route('/blogposts', name: 'app_blogposts')]
    public function show(): Response
    {
        $blogposts = $this->blogpostsRepository->findAll();


        return $this->render('blogposts/blogposts_show.html.twig', [
            'blogposts' => $blogposts
        ]);
    }
}
