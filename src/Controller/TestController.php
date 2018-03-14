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
    
    /**
     * @Route("/test/{id}", name="test_show")
     */
    public function showAction($id)
    {
        $test = $this->getDoctrine()
            ->getRepository(Test::class)
            ->find($id);

        if (!$test) {
            throw $this->createNotFoundException(
                'No test found for id '.$id
            );
        }

        return new Response('Check out this great product: '.$test->getDescription());

        // or render a template
        // in the template, print things with {{ product.name }}
        // return $this->render('product/show.html.twig', ['product' => $product]);
    }
    
    /**
     * @Route("/test/edit/{id}", name="test_edit")
     */
    
    public function updateAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $test = $entityManager->getRepository(Test::class)->find($id);

        if (!$test) {
            throw $this->createNotFoundException(
                'No test found for id '.$id
            );
        }

        $test->setDescription('New test name!');
        $entityManager->flush();

        return $this->redirectToRoute('test_show', [
            'id' => $test->getId()
        ]);
        //*/
    }
    
    /**
     * @Route("/test/delete/{id}", name="test_delete")
     */
    
    public function deleteAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $test = $entityManager->getRepository(Test::class)->find($id);

        if (!$test) {
            throw $this->createNotFoundException(
                'No test found for id '.$id
            );
        }

        
        $entityManager->remove($test);
        $entityManager->flush();

        return new Response('Entrada test #'.$id.' eliminada');

        /*
        return $this->redirectToRoute('test_show', [
            'id' => $test->getId()
        ]);
        //*/
    }
    
    /**
     * @Route("/test/all/", name="test_all")
     */
    
    public function allAction()
    {
        
        $test = $this->getDoctrine()->getRepository(Test::class)->findAll();
        
        if (!$test) {
            throw $this->createNotFoundException(
                'No test found.'
            );
        }
        
        $json = json_encode($test);
        
        return new Response('Test almacenados: '.$json);

        /*
        return $this->redirectToRoute('test_show', [
            'id' => $test->getId()
        ]);
        //*/
    }
    /**
     * @Route("/test/bigger/{id}", name="test_bigger")
     */
    
    public function biggerAction($id)
    {
        //$entityManager = $this->getDoctrine()->getManager();
        $test = $this->getDoctrine()->getRepository(Test::class)->findAllGreaterThanPrice($id);

        if (!$test) {
            throw $this->createNotFoundException(
                'No test found for id '.$id
            );
        }

        

        return new Response('Entrada test Encontradas:'.var_dump($test).' mayor a: '.$id);

        /*
        return $this->redirectToRoute('test_show', [
            'id' => $test->getId()
        ]);
        //*/
    }
}
