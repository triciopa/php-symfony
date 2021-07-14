<?php

// bin/console make:controller DefaultController

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function index(): Response
    {
        $users = ['Carlos','Fede','Pia','Iván','Nacho'];
        return $this->render('default/index.html.twig', [
            'controller_name' => 'Test Page',
            'users' => $users,
        ]);
    }

    
    // /**
    //  * @Route("/default/{name}", name="default")
    //  */
    // public function index($name): Response
    // {
    //     return $this->render('default/index.html.twig', [
    //         'controller_name' => 'DefaultController',
    //     ]);

    //     return $this->json(['username'=>'john.doe']);
    
    //     return new Response("Hello! $name");

    //     return $this->redirect('http://synfony.com');
    //     return $this->redirect('default2');
    //     return $this->redirectToRoute('default2');
    // }

    // /**
    //  * @Route("/default2", name="default2")
    //  */
    // public function index2(): Response
    // {
    //     return new Response('I come from default!');
    // }
}
