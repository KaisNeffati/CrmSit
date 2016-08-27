<?php
/**
 * Created by PhpStorm.
 * User: Kais NEFFATI
 * Date: 8/12/2016
 * Time: 12:02 PM
 */

namespace SIT\PlatformBundle\Controller;


use SIT\PlatformBundle\Form\personnelType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use SIT\PlatformBundle\Entity\personnel;

class personnelController extends Controller
{

    public function addPersonnelAction(Request $request,$id){
        $personnel=new personnel();
        $societe=$this->getDoctrine()->getManager()->getRepository('SITPlatformBundle:societe')->find($id);
        $personnel->setSociete($societe);
        $form = $this->createForm(personnelType::class, $personnel);
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
        $form = $this->createForm(personnelType::class, $personnel);
        $form->get('nom')->setData($personnel->getNom());
        $form->get('prenom')->setData($personnel->getPrenom());
        $form->get('fonction')->setData($personnel->getFonction());
        $form->get('tel')->setData($personnel->getTel());
        $form->get('email')->setData($personnel->getEmail());
        $form->get('description')->setData($personnel->getDescription());
        $form->get('nom')->setData($personnel->getNom());
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

    public function afficherPersonnelAction($id,$idpersonnel){
        $personnel=$this->getDoctrine()->getManager()->getRepository('SITPlatformBundle:personnel')->find($idpersonnel);
        return $this->render('SITPlatformBundle:personnel:afficherpersonnel.html.twig',array('personnel' => $personnel,'id'=>$id));
    }

}