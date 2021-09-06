<?php

namespace App\Controller;

use Doctrine\DBAL\Driver\Connection;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostController extends AbstractController
{
    public function index(Connection $connection): Response
    {
        $posts = $connection->fetchAll('
            SELECT posts.id, title, content, posts.creation_date, firstname, lastname
            FROM posts
            INNER JOIN users on users.id = posts.user_id
            ORDER BY creation_date DESC
       ');
        
        return $this->render('posts/index.html.twig', [
            'posts' => $posts    
        ]);
    }
    
    public function show(int $id, Connection $connection): Response
    {
        $post = $connection->fetchAssociative('
            SELECT posts.id, title, content, posts.creation_date, firstname, lastname
            FROM posts
            INNER JOIN users ON users.id = posts.user_id
            WHERE posts.id = ?
        ', [$id]);
        
        $comments = $connection->fetchAllAssociative('
            SELECT pseudo, content, creation_date
            FROM comments
            WHERE post_id = ?
            ORDER BY creation_date DESC
        ', [$id]);
        
        return $this->render('posts/show.html.twig', [
            'post' => $post,
            'comments' => $comments
        ]);
    }
}