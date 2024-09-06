<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PostRepository;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_posts')]
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findAllPosts();

        return $this->render('home/index.html.twig', [
            'posts' => $posts
        ]);
    }

    #[Route('/post/{id}', name: 'app_post_show')]
    public function show(PostRepository $postRepository, int $id): Response
    {
        $post = $postRepository->findPostById($id);

        if (!$post) {
            throw $this->createNotFoundException('Post not found');
        }

        return $this->render('home/post.html.twig', [
            'post' => $post
        ]);
    }
}
