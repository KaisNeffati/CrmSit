<?php
/**
 * Created by PhpStorm.
 * User: Kais NEFFATI
 * Date: 8/22/2016
 * Time: 5:29 PM
 */

namespace SIT\PlatformBundle\Controller;


use SIT\PlatformBundle\Entity\Demo;
use SIT\PlatformBundle\Form\DemoType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DemoController extends Controller
{
    public function ajouterDemoAction(Request $request,$id){
        $demo=new Demo();
        $societe=$this->getDoctrine()->getManager()->getRepository('SITPlatformBundle:Societe')->find($id);
        $demo->setSociete($societe);
        $form = $this->createForm(DemoType::class, $demo);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $task=$form->getData();
            $em=$this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();
            return $this->redirectToRoute('sit_societe',array('id'=>$id));
        }
        return $this->render('SITPlatformBundle:demo:ajouterDemo.html.twig',array(
            'form' => $form->createView(),'name'=>$societe->getNom(),'id'=>$societe->getId()));
    }

}
