<?php
/**
 * Created by PhpStorm.
 * User: Kais NEFFATI
 * Date: 8/12/2016
 * Time: 12:04 PM
 */

namespace SIT\PlatformBundle\Controller;


use SIT\PlatformBundle\Form\produitType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use SIT\PlatformBundle\Entity\produit;
use Symfony\Component\HttpFoundation\Request;


class produitController extends Controller
{

    public function ajouterProduitAction(Request $request,$id){
        $produit=new produit();
        $societe=$this->getDoctrine()->getManager()->getRepository('SITPlatformBundle:societe')->find($id);
        $produit->setSociete($societe);
        $produit->setPostDate(new \DateTime());
        $form = $this->createForm(produitType::class, $produit);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $task=$form->getData();
            $em=$this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
            return $this->redirectToRoute('sit_produit',array('id'=>$id,'idproduit'=>$produit->getId()));
        }
        return $this->render('SITPlatformBundle:produit:ajouterProduit.html.twig',array(
            'form' => $form->createView(),'name'=>$societe->getNom(),'id'=>$societe->getId()));
    }
    public function modifierProduitAction(Request $request,$id,$idproduit){
        $produit=$this->getDoctrine()->getManager()->getRepository('SITPlatformBundle:produit')->find($idproduit);
        $form = $this->createForm(produitType::class, $produit);
            $form->get('periodeLivraison')->setData($produit->getPeriodeLivraison());
            $form->get('libelle')->setData($produit->getLibelle());
            $form->get('type_d_installation')->setData($produit->getTypeDInstallation());
            $form->get('dateLivraison')->setData($produit->getDateLivraison());
            $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->getRepository('SITPlatformBundle:produit')->find($idproduit);
            $em->flush();
            return $this->redirectToRoute('sit_produit',array('id'=>$id,'idproduit'=>$idproduit));
        }
        return $this->render('SITPlatformBundle:produit:modifierProduit.html.twig',array(
            'form' => $form->createView(),'name'=>$produit->getSociete()->getNom(),'idproduit'=>$idproduit,'id'=>$produit->getSociete()->getId()));
    }
    public function supprimerProduitAction($id,$idproduit){
        $produit=$this->getDoctrine()->getManager()->getRepository('SITPlatformBundle:produit')->find($idproduit);
        $em=$this->getDoctrine()->getManager();
        $em->remove($produit);
        $em->flush();
        return $this->redirectToRoute('sit_societe',array('id'=>$id));
    }
    public function afficherProduitAction($id,$idproduit){
        $produit=$this->getDoctrine()->getManager()->getRepository('SITPlatformBundle:produit')->find($idproduit);
        $listetatproduit =$this->getDoctrine()->getManager()->getRepository('SITPlatformBundle:etatProduit')->findByProduit($produit);
        return $this->render('SITPlatformBundle:produit:afficherProduit.html.twig',array('listetatproduit' => $listetatproduit,'id' => $id ,'produit'=>$produit));
    }

}
