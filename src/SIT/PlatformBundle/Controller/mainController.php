<?php

/**
 * Created by PhpStorm.
 * User: Kais NEFFATI
 * Date: 8/3/2016
 * Time: 7:20 PM
 */
namespace SIT\PlatformBundle\Controller;
use SIT\PlatformBundle\Entity\note;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class mainController extends Controller
{
    public function indexAction(){
        if ($this->isGranted('ROLE_BUSINESS_DEVELOPER')) {
            $listSociete=$this->getDoctrine()->getManager()->getRepository('SITPlatformBundle:societe')->findAll();
            $listeNote=$this->getDoctrine()->getManager()->getRepository('SITPlatformBundle:note')->findall();
        }
        else{
            $usr= $this->getUser();
            $note=new note();
            $listeNote[]=$note;
            $listSociete=$this->getDoctrine()->getManager()->getRepository('SITPlatformBundle:societe')->findByCommercialGerant($usr);
            foreach($listSociete as $societe)
            {
                foreach($societe->getSocietenotes() as $notes){
                    $listeNote[]=$notes;
                }
            }
        }
        return $this->render('SITPlatformBundle:commercial:index.html.twig',array('listSociete' => $listSociete,'listNote'=>$listeNote));
}

}
