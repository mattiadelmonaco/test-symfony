<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BlogController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {

        $posts = [
            ['title' => 'Primo post', 'slug' => 'primo-post'],
            ['title' => 'Secondo post', 'slug' => 'secondo-post'],
        ];

        return $this->render('blog/index.html.twig', ['posts' => $posts,]);
    }
}
