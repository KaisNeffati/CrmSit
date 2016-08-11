<?php

/**
 * Created by PhpStorm.
 * User: Kais NEFFATI
 * Date: 8/3/2016
 * Time: 7:20 PM
 */
namespace SIT\PlatformBundle\Controller;
use SIT\PlatformBundle\Entity\produit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use SIT\PlatformBundle\Entity\personnel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class mainController extends Controller
{
    public function indexAction(){
        $listSociete=$this->getDoctrine()->getManager()->getRepository('SITPlatformBundle:societe')->findAll();
    return $this->render('SITPlatformBundle:commercial:index.html.twig',array('listSociete' => $listSociete));
}
    public function viewAction($id){
        $societe=$this->getDoctrine()->getManager()->getRepository('SITPlatformBundle:societe')->find($id);
        $listeNote=$this->getDoctrine()->getManager()->getRepository('SITPlatformBundle:note')->findBy(array('societe' => $societe));
        $listpersonnel=$this->getDoctrine()->getManager()->getRepository('SITPlatformBundle:personnel')->findBy(array('societe' => $societe));
        $listproduit=$this->getDoctrine()->getManager()->getRepository('SITPlatformBundle:produit')->findBy(array('societe' => $societe));
        return $this->render('SITPlatformBundle:commercial:societe.html.twig',array('societe' => $societe,'listNote'=>$listeNote,'listpersonnel'=>$listpersonnel,'listproduit'=>$listproduit));
    }
    public function addPersonnelAction(Request $request,$id){
        $personnel=new personnel();
        $societe=$this->getDoctrine()->getManager()->getRepository('SITPlatformBundle:societe')->find($id);
        $personnel->setSociete($societe);
        $form=$this->createFormBuilder($personnel)
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class)
            ->add('fonction',TextType::class)
            ->add('tel',IntegerType::class)
            ->add('email',EmailType::class)
            ->add('description',TextareaType::class)
            ->add('enregister', SubmitType::class, array('label' => 'Enregister'))->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $task=$form->getData();
            $em=$this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
            return $this->redirectToRoute('sit_societe',array('id'=>$id));
        }
        return $this->render('SITPlatformBundle:commercial:ajouterPersonnel.html.twig',array(
            'form' => $form->createView(),'name'=>$societe->getNom(),'id'=>$societe->getId()));
    }

    public function editPersonnelAction(Request $request,$id,$idpersonnel){
        $personnel=$this->getDoctrine()->getManager()->getRepository('SITPlatformBundle:personnel')->find($idpersonnel);
        $form=$this->createFormBuilder($personnel)
            ->add('nom',TextType::class,array('data'=>$personnel->getNom()))
            ->add('prenom',TextType::class,array('data'=>$personnel->getPrenom()))
            ->add('fonction',TextType::class,array('data'=>$personnel->getFonction()))
            ->add('tel',IntegerType::class,array('data'=>$personnel->getTel()))
            ->add('email',EmailType::class,array('data'=>$personnel->getEmail()))
            ->add('description',TextareaType::class,array('data'=>$personnel->getDescription()))
            ->add('enregister', SubmitType::class, array('label' => 'Enregister'))->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->getRepository('SITPlatformBundle:personnel')->find($idpersonnel);
            $em->flush();
            return $this->redirectToRoute('sit_societe',array('id'=>$id));
        }
        return $this->render('SITPlatformBundle:commercial:modifierPersonnel.html.twig',array(
            'form' => $form->createView(),'name'=>$personnel->getSociete()->getNom(),'id'=>$personnel->getSociete()->getId()));


    }
    public function deletePersonnelAction($id,$idpersonnel){
        $personnel=$this->getDoctrine()->getManager()->getRepository('SITPlatformBundle:personnel')->find($idpersonnel);
        $em=$this->getDoctrine()->getManager();
        $em->remove($personnel);
        $em->flush();
        return $this->redirectToRoute('sit_societe',array('id'=>$id));
    }

    public function ajouterProduitAction(Request $request,$id){
        $produit=new produit();
        $societe=$this->getDoctrine()->getManager()->getRepository('SITPlatformBundle:societe')->find($id);
        $produit->setSociete($societe);
        $form=$this->createFormBuilder($produit)
            ->add('status',TextType::class)
            ->add('periodeLivraison',TextType::class)
            ->add('libelle',TextType::class)
            ->add('type_d_installation',TextType::class)
            ->add('budget',MoneyType::class)
            ->add('enregister', SubmitType::class, array('label' => 'Enregister'))->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $task=$form->getData();
            $em=$this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
            return $this->redirectToRoute('sit_societe',array('id'=>$id));
        }
        return $this->render('SITPlatformBundle:produit:ajouterProduit.html.twig',array(
            'form' => $form->createView(),'name'=>$societe->getNom(),'id'=>$societe->getId()));
    }
    public function modifierProduitAction(Request $request,$id,$idproduit){
        $produit=$this->getDoctrine()->getManager()->getRepository('SITPlatformBundle:produit')->find($idproduit);
        $form=$this->createFormBuilder($produit)
            ->add('status',TextType::class,array('data'=>$produit->getStatus()))
            ->add('periodeLivraison',TextType::class,array('data'=>$produit->getPeriodeLivraison()))
            ->add('libelle',TextType::class,array('data'=>$produit->getLibelle()))
            ->add('type_d_installation',TextType::class,array('data'=>$produit->getTypeDInstallation()))
            ->add('budget',IntegerType::class,array('data'=>$produit->getBudget()))
            ->add('enregister', SubmitType::class, array('label' => 'Enregister'))->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->getRepository('SITPlatformBundle:produit')->find($idproduit);
            $em->flush();
            return $this->redirectToRoute('sit_societe',array('id'=>$id));
        }
        return $this->render('SITPlatformBundle:produit:ajouterProduit.html.twig',array(
            'form' => $form->createView(),'name'=>$produit->getSociete()->getNom(),'id'=>$produit->getSociete()->getId()));


    }
    public function supprimerProduitAction($id,$idproduit){
        $produit=$this->getDoctrine()->getManager()->getRepository('SITPlatformBundle:produit')->find($idproduit);
        $em=$this->getDoctrine()->getManager();
        $em->remove($produit);
        $em->flush();
        return $this->redirectToRoute('sit_societe',array('id'=>$id));
    }
    public function afficherPersonnelAction($id,$idpersonnel){
        $personnel=$this->getDoctrine()->getManager()->getRepository('SITPlatformBundle:personnel')->find($idpersonnel);
        return $this->render('SITPlatformBundle:personnel:afficherpersonnel.html.twig',array('personnel' => $personnel,'id'=>$id));
    }
    public function afficherProduitAction($id,$idproduit){
        $produit=$this->getDoctrine()->getManager()->getRepository('SITPlatformBundle:produit')->find($idproduit);
        return $this->render('SITPlatformBundle:produit:afficherProduit.html.twig',array('produit' => $produit,'id'=>$id));
    }

}