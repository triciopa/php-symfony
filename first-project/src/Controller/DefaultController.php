<?php

// bin/console make:controller DefaultController

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Services\GiftsService;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class DefaultController extends AbstractController
{
    // BIND SERVICE in services.yaml
    public function __construct($logger)
    {
        // use $logger service
    }

    // OVERRIDE SERVICE ARRAY
    // public function __construct(GiftsService $gifts)
    // {
    //     $gifts->gifts = ['a','b','c','d','e'];
    // }

    /**
     * @Route("/", name="default")
     */
    public function index(GiftsService $gifts, Request $request, SessionInterface $session): Response
    {
        // DATABASE HANDLING
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

        $users = $this->getDoctrine()->getRepository(User::class)->findAll();

        // EXEPTIONS
        if (!$users) {
            throw $this->createNotFoundException('The users do not exist');
        };

        // GET & POST METHOD
        // exit($request->query->get('page', 'default'));  
        // exit($request->server->get('HTTP_POST'));
        // $request->isXmlHttpRequest();
        // $request->request->get('page');
        // $request->files->get('foo'); // foo is html element


        // SESSIONS
        // exit($request->cookies->get('PHPSESSID'));
        $session->set('name', 'session value');
        $session->remove('name'); // continues and renders
        $session->clear(); //clear any session
        if ($session->has('name')) {
            echo $request->cookies->get('PHPSESSID') . '<br>';
            exit($session->get('name'));
        }

        // CREATE COOKIE
        $cookie = new Cookie(
            'cookie_name',
            'cookie_value',
            time() + (2 * 365 * 24 * 60 * 60) // expires after 2 years
        );

        // SET COOKIE
        // $res = new Response();
        // $res->headers->setCookie($cookie);
        // $res->send();

        // ERASE COOKIE
        // $res = new Response();
        // $res->headers->clearCookie('cookie_name');
        // $res->send();

        // FLASHES
        // $this->addFlash('notice', 'Your changes were saved');
        // $this->addFlash('warning', 'This has "warning" class');

        return $this->render('default/index.html.twig', [
            'controller_name' => 'Test Page',
            'users' => $users,
            'random_gift' => $gifts->gifts,
        ]);
    }

    // ADVANCED ROUTES
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
    /**
     * @Route("/generate-url/{param?}", name="generate_url")
     */
    public function generate_url()
    {
        exit($this->generateUrl(
            'generate_url',
            array('param' => 10),
            UrlGeneratorInterface::ABSOLUTE_URL
        ));
    }
    /**
     * @Route("/download")
     */
    public function download()
    {
        $path = $this->getParameter('download_directory');
        return $this->file($path . 'file.pdf');
    }
    /**
     * @Route("/redirect-test")
     */
    public function redirectTest()
    {
        return $this->redirectToRoute('route_to_redirect', array('param' => 10));;
    }
    /**
     * @Route("/url-to-redirect/{param?}", name="route_to_redirect")
     */
    public function methodToRedirect()
    {
        exit('Test redirection');
    }

    // BASIC CONTROLLERS
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
