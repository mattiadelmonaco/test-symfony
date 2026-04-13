<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserRepository;
use App\Repository\PostRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\DateImmutableType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class BlogController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PostRepository $postRepository): Response
    {

        $posts = $postRepository->findAll();

        return $this->render('blog/index.html.twig', ['posts' => $posts,]);
    }

    #[Route('/post/new', name: 'app_post_new')]
    public function new(Request $request, EntityManagerInterface $em, UserRepository $userRepository): Response
    {
        $post = new Post;
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $post->setSlug(strtolower(str_replace(' ', '-', $post->getTitle())));
            $post->setCreatedAt(new \DateTimeImmutable());
            $post->setIsPublished(false);
            $post->setAuthor($userRepository->find(1));
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('blog/new.html.twig', ['form' => $form]);
    }

    #[Route('post/{slug}', name: 'app_post_show')]
    public function show(string $slug, PostRepository $postRepository): Response
    {
        $post = $postRepository->findOneBy(['slug' => $slug]);

        return $this->render('blog/show.html.twig', ['post' => $post]);
    }
}
