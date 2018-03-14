<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\Entity\Test;

class TestController extends Controller
{
    /**
     * @Route("/test", name="test")
     */
    public function index()
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to your action: index(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();

        $test = new Test();
        $test->setDescription('Ergonomic and stylish!');

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($test);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Salvado una nueva prueba con la id '.$test->getId());
        /*
        
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
        */
    }
}
