<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostMapper;
use App\Repository\PostRepository;
use GaryClarke\Framework\Controller\AbstractController;
use GaryClarke\Framework\Http\Request;
use GaryClarke\Framework\Http\Response;

class PostsController extends AbstractController
{
    public function __construct(
        private PostMapper $postMapper,
        private PostRepository $postRepository
    )
    {
    }

    public function show(int $id): Response
    {
        $post = $this->postRepository->findOrFail($id);

        return $this->render('post.html.twig', [
            'post' => $post
        ]);
    }

    public function create(): Response
    {
        return $this->render('create-post.html.twig');
    }

    public function store(): void
    {
        $title = $this->request->postParams['title'];
        $body = $this->request->postParams['body'];

        $post = Post::create($title, $body);

        $this->postMapper->save($post);

        dd($post);
    }
}