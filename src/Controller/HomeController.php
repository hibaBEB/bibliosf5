<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\LivreRepository;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(LivreRepository $livreRepo) :Response 
    //Reponse: classe qui retourne la methode qui suit
    {
        $livres /*on crée la variable*/  = $livreRepo->findAll();
        return $this->render('home/index.html.twig', [
            'livres'/*indice du nom dela var*/ => $livres,/*variable tableau qui contient les indices*/ 
        ]);
    }
    public function fiche (LivreRepository $livreRepository,int $id) 
    //(LivreRepository/*on utilise cette class*/,$livreRepository/**/,int $id /*ici parametre int pour chiffre uniquement*/): Response //Livre=>table livre/$livre=>parametre ex:id et (Livre $livre)=>objet
    {
        $livreAfficher = $livreRepository->find($id);
        return $this->render('livre/affiche.html.twig', [
            "livre" => $livreAfficher
            
        ]);
    }
  

}
 
   