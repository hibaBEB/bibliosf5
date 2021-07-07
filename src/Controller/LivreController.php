<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Form\LivreType;
use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
 

/**
 * @Route("/livre")
 */
class LivreController extends AbstractController
{
    /**
     * @Route("/", name="livre_index", methods={"GET"})
     */
    public function index(LivreRepository $livreRepository): Response
    {
        return $this->render('livre/index.html.twig', [
            'livres' => $livreRepository->findAll(),
        ]);
    }

    /**
     * @Route("/ajouter", name="livre_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $livre = new Livre();
        //dump($livre);

        //on crée un objet sui servira à gérer les formulaires .cet objet est créé à partir de la classe LivreTYpe,et on relie  ce formulaire l'objet $livre  
        //la classe=> LivreType::class,relie a => $livre
        $form = $this->createForm(LivreType::class, $livre);

        //On récupere ce qui vient du formulaire envoyé par l'utilisateur($_post).si le formulaire a été soumis,

        $form->handleRequest($request);
       // dd($livre);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            //Pour Ajouter un enregistrement en bdd=>persist de l'entitéMAnager:le paramétres doit étre un objet d'une class Entity =php INSERT TO
            $entityManager->persist($livre);
            //executer les requêtes en attente => methode flush
            $entityManager->flush();
            //on redirige vers la route 'livre_index'(liste des livres)
            return $this->redirectToRoute('livre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('livre/new.html.twig', [
            'livre' => $livre, //livre et forme sont des variables
            'form' => $form,
        ]);
    }


        /**
     * L'option requirements permet de préciser à quoi doit ressembler un paramètre
     * de l'URL. Dans l'exemple, le paramètre {id} doit être composé uniquement de chiffres
     * 
     * @Route("/{id}", name="livre_show", methods={"GET"}, requirements={"id"="[0-9]+"})
     */


    public function show(Livre $livre): Response //Livre=>table livre/$livre=>parametre ex:id et (Livre $livre)=>objet
    {
        return $this->render('livre/show.html.twig', [
            'livre' => $livre,
            
        ]);
    }

    /**
     * @Route("/{id}/modifier", name="livre_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Livre $livre): Response
    {
        $form = $this->createForm(LivreType::class, $livre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            //Quand oncrée des variables entités à partir d'informations récupérés en bdd,toutesnles modifications faites sur ces objets vont être enregitrés en bdd lorsque la méthode 'flush' de l'entityManager sera éxécutée 
            //ici,$livre est récupéré en bdd à partir de l'id qui est dans l'URL ,le formulaire modifie les valeurs de $livre
            return $this->redirectToRoute('livre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('livre/edit.html.twig', [
            'livre' => $livre,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="livre_delete", methods={"POST"})
     */
    public function delete(Request $request, Livre $livre): Response
    {
        if ($this->isCsrfTokenValid('delete'.$livre->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($livre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('livre_index', [], Response::HTTP_SEE_OTHER);
    }


    /**
     * @Route("/fiche/{id}", name="livre_fiche", methods={"GET"},requirements={"id"="[0-9]+"})
     */
    
    public function fiche (LivreRepository $livreRepository,int $id) 
    //(LivreRepository/*on utilise cette class*/,$livreRepository/**/,int $id /*ici parametre int pour chiffre uniquement*/): Response //Livre=>table livre/$livre=>parametre ex:id et (Livre $livre)=>objet
    {
        $livreAfficher = $livreRepository->find($id);
        return $this->render('livre/affiche.html.twig', [
            "livre" => $livreAfficher
            
        ]);
    }

     
    
    




}
