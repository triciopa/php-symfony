<?php

// bin/console make:controller DefaultController

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(): Response
    {             
        // $users = ['Carlos','Fede','Pia','Iván','Nacho'];
                
        // $entityManager = $this->getDoctrine()->getManager();

        // $user = new User;
        // $user->setName('Carlos');
        // $user2 = new User;
        // $user2->setName('Fede');
        // $user3 = new User;
        // $user3->setName('Pia');
        // $user4 = new User;
        // $user4->setName('Iván');
        // $user5 = new User;
        // $user5->setName('Nacho');
        
        // $entityManager->persist($user);
        // $entityManager->persist($user2);
        // $entityManager->persist($user3);
        // $entityManager->persist($user4);
        // $entityManager->persist($user5);
        
        // $entityManager->flush();

        // bin/console make:migration
        // bin/console doctrine:migrations:migrate

        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
        $gifts = ['flowers','car','piano','money','bricks'];
        shuffle($gifts);



        return $this->render('default/index.html.twig', [
            'controller_name' => 'Test Page',
            'users' => $users,
            'random_gift' => $gifts,
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
