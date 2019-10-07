<?php

namespace App\Controller;

use App\Entity\Visiteur;
use App\Form\VisiteurType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class VisiteurController extends AbstractController
{
    /**
     * @Route("/visiteur", name="visiteur")
     */
public function creerForm(Request $query)
{
// On crée un objet Candidat
$prod = new Visiteur();

//Créer un objet de type formulaire
$form = $this->createForm(VisiteurType::class, $prod);

$form->handleRequest($query);

// Dans le contrôleur

//Dans le contrôleur
// Méthode d'envoi de la requête
if ($query->isMethod('POST')) {
// On vérifie que les valeurs entrées sont correctes
    if ($form->isValid()) {
// On enregistre notre objet $advert dans la base de données, par exemple
        $em = $this->getDoctrine()->getManager();
        $em->persist($prod);
        $em->flush();
        $query->getSession()->getFlashBag()->add('notice', 'Visiteur enregistré.');
// On redirige vers la page de visualisation du candidat créé
    return $this->render('visiteur/cbon.html.twig', array('id' =>
$prod->getId()));
}}

// Erreur dans le formulaire => retour vers ce dernier
return $this->render('visiteur/formVisiteur.html.twig', array('form' => $form->createView(),));
}



/**
*
*@Route("/visiteur/update/{id}",name="upd_route1")
*
*/
public function updateVisiteur(Request $request, $id){
$visiteur = new Visiteur() ;
$visiteur = $this->getDoctrine()->getManager()->getRepository(Visiteur::class)->getUnVisiteur($id);
//$id = $session->get('login');
$request->getSession()->getFlashBag()->add('notice', '');
$form = $this->createForm(VisiteurType::class, $visiteur);
if($request->isMethod('POST')){
$form->handleRequest($request);
if($form->isValid()){
$em = $this->getDoctrine()->getManager();
$em->flush();
$request->getSession()->getFlashBag()->add('success', 'Visiteur modifié

avec succès.');

return $this->redirectToRoute('upd_route1',array('id'=>$id));
}
}
return $this->render( 'visiteur/update.html.twig', array(
'form' =>$form->createView(), 'bien'=>$visiteur));
}
    /**
     * @Route("/afficher_visiteur", name="Afficher_visiteur")
     */
    public function AfficherVisiteur(){
        $em = $this->getDoctrine()->getManager();
 
        $unVisiteur = $em->getRepository(Visiteur::class)->findAllVisiteurs();
        
        return $this->render('visiteur/liste.html.twig', array('visiteur' => $unVisiteur));
        
    }



    /**
      *
      *@Route("/visiteur/supprimer/{id}",name="del_vis")
      *
      */
    public function deleteVisiteur(Session $session, $id){
        $visiteur = $this->getDoctrine()->getManager()->getRepository(Visiteur::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($visiteur);
        $em->flush();
        return $this->redirectToRoute('affichage_final');
    }
    /**
      *
      *@Route("/visiteur/afficher",name="affichage_final")
      *
      */
    public function indexAction(){
     
        $article = $this->getDoctrine()->getManager()->getRepository(Visiteur::class)->findAllVisiteurs();
        return $this->render('visiteur/liste.html.twig', array('articles'=>$article));
    }
}



