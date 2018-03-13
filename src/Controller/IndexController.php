<?php
// src/Controller/IndexController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class IndexController extends Controller
{
    //
    //@Route("/number", name="number")
    //
    public function number()
    {
        $number = mt_rand(0, 100);

        return new Response(
            '<html><body>Lucky number:'.$number.'</body></html>'
        );
    }
    
    
    //
    //@Route("/", name="index")
    //
    public function index()
    {
        
        return $this->render('base.html.twig');
    }
    
    //
    //@Route("/{name}", name="name")
    //
    public function hello($name="SomeGuy")
    {
        
        return new Response(
            '<html><body>Hola '.$name.'</body></html>'
        );
    }
}
?>