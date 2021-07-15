<?php

// bin/console make:controller DefaultController

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Services\GiftsService;
use Symfony\Component\HttpFoundation\Cookie;

class DefaultController extends AbstractController
{
    // OVERRIDE SERVICE ARRAY
    // public function __construct(GiftsService $gifts)
    // {
    //     $gifts->gifts = ['a','b','c','d','e'];
    // }

    /**
     * @Route("/", name="default")
     */
    public function index(GiftsService $gifts): Response
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

        $cookie = new Cookie(
            'cookie_name',
            'cookie_value',
            time() + (2 * 365 * 24 * 60 * 60) // expires after 2 years
        );

        // CREATE COOKIE
        // $res = new Response();
        // $res->headers->setCookie($cookie);
        // $res->send();

        // ERASE COOKIE
        $res = new Response();
        $res->headers->clearCookie('cookie_name');
        $res->send();

        $this->addFlash('notice', 'Your changes were saved');
        $this->addFlash('warning', 'This has "warning" class');

        return $this->render('default/index.html.twig', [
            'controller_name' => 'Test Page',
            'users' => $users,
            'random_gift' => $gifts->gifts,
        ]);
    }

    /** 
     * @Route ("/blog/{page?}", name="blog_list", requirements={"page"="\d+"})
     * 
     */
    public function index2(): Response
    {
        // needs a number as parameter, with question mark it's optional
        return new Response('Optional parameters in url and requirements for this');
    }

    /**
     * @Route(
     *      "/articles/{_locale}/{year}/{slug}/{category}",
     *      defaults={"category": "computers"},
     *      requirements={
     *         "_locale": "en|fr",
     *         "category": "computers|rtv",
     *         "year": "\d+"
     *      }
     * )
     */
    public function index3(): Response
    {
        return new Response('An advanced route example');
    }

    /**
     * @Route({
     *      "nl": "/over-ons", 
     *      "en": "/about-us"
     *      },
     *      name="about_us"
     * )
     */
    public function index4(): Response
    {
        return new Response('Translated routes');
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
