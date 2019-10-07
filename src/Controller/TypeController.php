<?php

namespace App\Controller;

use App\Entity\Type;
use App\Form\TypeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
class TypeController extends AbstractController
{
    /**
     * @Route("/type", name="type")
     */
    
    
    public function creerForm(Request $query)
{
// On crée un objet Candidat
    $cat = new Type();

//Créer un objet de type formulaire
$form = $this->createForm(TypeType::class, $cat);

$form->handleRequest($query);

// Dans le contrôleur

//Dans le contrôleur
// Méthode d'envoi de la requête
if ($query->isMethod('POST')) {
// On vérifie que les valeurs entrées sont correctes
    if ($form->isValid()) {
// On enregistre notre objet $advert dans la base de données, par exemple
        $em = $this->getDoctrine()->getManager();
        $em->persist($cat);
        $em->flush();
        $query->getSession()->getFlashBag()->add('notice', 'Libelle enregistré.');
// On redirige vers la page de visualisation du candidat créé
    return $this->render('type/cbon.html.twig', array('id' =>
    $cat->getId()));
    }}

// Erreur dans le formulaire => retour vers ce dernier
    return $this->render('type/formType.html.twig', array('form' => $form->createView(),));
    }

}
