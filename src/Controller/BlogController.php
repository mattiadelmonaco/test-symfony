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

    #[Route('post/{slug}', name: 'app_post_show')]
    public function show(string $slug): Response
    {
        $post = [
            'title' => 'Titolo del post',
            'slug' => $slug,
            'content' => 'Contenuto del post',
        ];

        return $this->render('blog/show.html.twig', ['post' => $post]);
    }
}
