<?php
/**
 * Created by PhpStorm.
 * User: Kais NEFFATI
 * Date: 8/12/2016
 * Time: 12:26 PM
 */

namespace SIT\PlatformBundle\Controller;


use SIT\PlatformBundle\Entity\note;
use SIT\PlatformBundle\Form\noteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class noteController extends Controller
{
    public function ajouterNoteAction(Request $request,$id){
        $note=new note();
        $societe=$this->getDoctrine()->getManager()->getRepository('SITPlatformBundle:societe')->find($id);
        $note->setSociete($societe);
        $note->setNoteafaire(0);
        $note->setPostDate(new \DateTime);
        $form = $this->createForm(noteType::class, $note);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $task=$form->getData();
            $em=$this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
            return $this->redirectToRoute('sit_societe',array('id'=>$id));
        }
        return $this->render('SITPlatformBundle:note:ajouterNote.html.twig',array(
            'form' => $form->createView(),'name'=>$societe->getNom(),'id'=>$societe->getId()));
    }
    public function ajouterNoteAFaireAction(Request $request,$id){
        $note=new note();
        $datenow=new \DateTime;
        $societe=$this->getDoctrine()->getManager()->getRepository('SITPlatformBundle:societe')->find($id);
        $note->setSociete($societe);
        $note->setNoteafaire(1);
        $note->setPostDate($datenow);
        $form = $this->createForm(noteType::class, $note);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $task=$form->getData();
            $em=$this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
            return $this->redirectToRoute('sit_societe',array('id'=>$id));
        }
        return $this->render('SITPlatformBundle:note:ajouterNote.html.twig',array(
            'form' => $form->createView(),'name'=>$societe->getNom(),'id'=>$societe->getId()));
    }
    public function modifierNoteAction(Request $request,$id,$idnote){
        $note=$this->getDoctrine()->getManager()->getRepository('SITPlatformBundle:note')->find($idnote);
        $form = $this->createForm(noteType::class, $note);
        $form->get('date')->setData($note->getDate());
        $form->get('description')->setData($note->getDescription());
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->getRepository('SITPlatformBundle:produit')->find($idnote);
            $em->flush();
            return $this->redirectToRoute('sit_societe',array('id'=>$id));
        }
        return $this->render('SITPlatformBundle:note:ajouterNote.html.twig',array(
            'form' => $form->createView(),'name'=>$note->getSociete()->getNom(),'id'=>$note->getSociete()->getId()));
    }
    public function supprimerNoteAction($id,$idnote){
        $note=$this->getDoctrine()->getManager()->getRepository('SITPlatformBundle:note')->find($idnote);
        $em=$this->getDoctrine()->getManager();
        $em->remove($note);
        $em->flush();
        return $this->redirectToRoute('sit_societe',array('id'=>$id));
    }
}
