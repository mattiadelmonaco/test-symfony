<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api', name: 'api_')]
final class ApiPostController extends AbstractController
{
    #[Route('/posts', name: 'posts', methods: ['GET'])]
    public function index(PostRepository $postRepository): JsonResponse
    {
        $posts = $postRepository->findAll();

        return $this->json($posts, 200, [], ['groups' => 'post:read']);
    }

    #[Route('/posts/{id}', name: 'post_show', methods: ['GET'])]
    public function show(int $id, PostRepository $postRepository): JsonResponse
    {
        $post = $postRepository->find($id);

        if (!$post) {
            return $this->json(['error' => 'Post non trovato'], 404);
        }

        return $this->json($post, 200, [], ['groups' => 'post:read']);
    }
}
