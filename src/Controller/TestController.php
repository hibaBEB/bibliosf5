<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index(): Response //response est une class peut etre=>integer string /bolen ////toute les methodes liees a une root renvoie 
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }



//Annotation sous forme de commentaire particulier php qui permet dans symfony de faire des routes
// en url quand on met / test on execute la methode salut

    /**
     * @Route("/test/salut", name="test_salut")
     */
    public function salut()
    {
        return $this->render('test/salut.html.twig',["prenom"=>"serge"] );
        //render permet l'affichage heriter d'extends AbstractController
        //test/salut.html.twig' nom du fichier pour l'affichage qui est dans templates vue
        //["prenom (vaiable)"=>"serge (valeur)"] paramétres d'affichage
    }



    //Ajouter une route pour l(url /test/calcul qui affiche : 5+10=15)

    /**
     * @Route("/test/calcul", name="test_calcul")
     */
    //public function calcul()
    //{
    //    return $this->render('test/calcul.html.twig',["op"=>"5+10=15"] );
    //    //render permet l'affichage heriter d'extends AbstractController
    //    //test/salut.html.twig' nom du fichier pour l'affichage qui est dans //templates vue
    //    //["prenom (vaiable)"=>"serge (valeur)"] paramétres d'affichage
    //}

    public function calcul()
    {   $a=7;
        $b=12;
       //$c=$a+$b;
       //return $this->render('test/calcul.html.twig',["a"=>"$a","b"=>"$b","c"=>"$c"] );
        //render permet l'affichage heriter d'extends AbstractController
        //test/salut.html.twig' nom du fichier pour l'affichage qui est dans templates vue
        //["prenom (variable)"=>"serge (valeur)"] paramétres d'affichage
        return $this->render('test/calcul.html.twig',["a"=>"$a","b"=>"$b"] );
    }

    /** Ici on crée une root(dans lient entre l'url methode a éxécuté) paramétré {a}=valeur passé en paramétre
     * @Route("/test/calcul/{a}", name="test_calcul")
     */
    //public function routeParametree($a)
    //{
    //    $b=12;
    //    return $this->render('test/calcul.html.twig',["a"=>"$a","b"=>"$b"] );
    //}  ------------------------

    /** 
     * @Route("/test/math/{a}/{b}")
    */
    public function routeParametree($a,$b)
    {
        return $this->render('test/calcul.html.twig',["a"=>"$a","b"=>"$b"]);   
     }


     //-----------EXO----------
        //faire une route qui affiche le carré d'un nombre passé en paramétre de la route
            //ex: /test/carre/4 affichera le carré de 4 qui est 16

            
    /**
    * @Route("test/carre/{x}")
    */

    public function calculCarre($x)
    {
        return $this->render('test/carre.html.twig',["nb"=>$x]);// ici tableau nb variable du tableau);
    }

     /**
    * @Route("base/")
    */

    public function afficher()
    {
        return $this->render('base.html.twig');// ici tableau nb variable du tableau);
    }
    
 }