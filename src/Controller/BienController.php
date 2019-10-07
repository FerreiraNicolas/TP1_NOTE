<?php

namespace App\Controller;
use App\Entity\Bien;
use App\Form\BienType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class BienController extends AbstractController
{
    /**
     * @Route("/bien", name="bien")
     */
public function creerForm(Request $query)
{
// On crée un objet Candidat
$prod = new Bien();

//Créer un objet de type formulaire
$form = $this->createForm(BienType::class, $prod);

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
        $query->getSession()->getFlashBag()->add('notice', 'Libelle enregistré.');
// On redirige vers la page de visualisation du candidat créé
    return $this->render('bien/cbon.html.twig', array('id' =>
$prod->getId()));
}}

// Erreur dans le formulaire => retour vers ce dernier
return $this->render('bien/formBien.html.twig', array('form' => $form->createView(),));
}



/**
*
*@Route("/bien/update/{id}",name="upd_route")
*
*/
public function updateBien(Request $request, $id){
    $bien = new Bien() ;
    $bien = $this->getDoctrine()->getManager()->getRepository(Bien::class)->getUnBien($id);
    //$id = $session->get('login');
    $request->getSession()->getFlashBag()->add('notice', '');
    $form = $this->createForm(BienType::class, $bien);
    if($request->isMethod('POST')){
        $form->handleRequest($request);
    if($form->isValid()){
        $em = $this->getDoctrine()->getManager();
        $em->flush();
    $request->getSession()->getFlashBag()->add('success', 'Article modifié

avec succès.');

return $this->redirectToRoute('upd_route',array('id'=>$id));
}
}
return $this->render( 'bien/update.html.twig', array(
'form' =>$form->createView(), 'bien'=>$bien));
}

    /**
     * @Route("/afficher_bien", name="Afficher_bien")
     */
    public function AfficherBien(){
        $em = $this->getDoctrine()->getManager();
 
        $unBien = $em->getRepository(Bien::class)->findAll();
        
        return $this->render('bien/liste.html.twig', array('bien' => $unBien));
        
    }


    /**
      * @Route("/liste_bien_type/{id}", name="listebientype")
      */
     
    public function listerBienParType(Request $request, $id) {
       
        $em = $this->getDoctrine()->getManager();
        $valeur = $em->getRepository(Bien::class)->rechercherParType($id);    
        return $this->render('bien/listeType.html.twig',array('result'=>$valeur));
     }
     
     

    /**
      *
      *@Route("/bien/supprimer/{id}",name="del_bien")
      *
      */
    public function deleteBien(Session $session, $id){
        $bien = $this->getDoctrine()->getManager()->getRepository(Bien::class)->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($bien);
        $em->flush();
        return $this->redirectToRoute('affichage_final_bien');
    }
    /**
      *
      *@Route("/bien/afficher",name="affichage_final_bien")
      *
      */
    public function indexActionn(){
     
        $unBien = $this->getDoctrine()->getManager()->getRepository(Bien::class)->findAllBiens();
        return $this->render('bien/liste.html.twig', array('bien' => $unBien));
    }     

}
