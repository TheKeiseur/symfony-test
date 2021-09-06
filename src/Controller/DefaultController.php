<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('homepage.html.twig');
        // return new Response('<p>Hello world</p>');
    }
    
    public function hello(string $name, int $age): Response
    {
        $friends = [
            [
                'firstname' => 'John',
                'lastname' => 'Doe',
                'birthdate' => new \DateTime('1978-10-10')
            ],
            [
                'firstname' => 'Jane',
                'lastname' => 'Doe',
                'birthdate' => new \DateTime('1985-10-10')
            ],
            [
                'firstname' => 'Jay',
                'lastname' => 'Doe',
                'birthdate' => new \DateTime('2000-10-10')
            ],
        ];
        
        return $this->render('hello.html.twig', [
            'name' => $name,
            'age' => $age,
            'friends' => $friends
        ]);
    }
}