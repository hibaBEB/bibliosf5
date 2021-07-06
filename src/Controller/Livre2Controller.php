<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\LivreRepository;

class Livre2Controller extends AbstractController
{
    /**
     * @Route("/livre", name="livre")
     */
    public function index(LivreRepository $lr): Response 
    //LivreRepositery*=>paramétres et $lr =>instanciation
    //je peux donc utiliser $lr de type LivreRepositery puisqu'il sera passé en paramétre
    
    //autowiring ou injection de dépendance en la passant en paramétres,elle va étre instancier automatiquement (class service de symfony)
    //pour interroger la bdd on utilise la class repository qui y correspond
    {
       // $lr= new LivreRepositery(); //on est sensé instancier l'objet(poo) mais ne marche pas avec symfony!!!!
        /**Certaines classes de symfony de vont pas pouvoir être instancier directement.
         * Il faut utiliser l'injection de dépendance,on va donc passer l'objet dont on a besoin en paramétres de la méthode index()
         */

        $livres=$lr->findAll(); //la variable $livres sera un array qui contient des objets de la class Livre
        return $this->render('livre/index.html.twig', [
            'livres' => $livres,
        ]);
    }
}
