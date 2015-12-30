<?php

namespace PHuN\PlatformBundle\Controller;

use PHuN\PlatformBundle\Entity\Advert;
use PHuN\PlatformBundle\Entity\Application;
use PHuN\PlatformBundle\Entity\Image;
use PHuN\PlatformBundle\Entity\Transcription;
use PHuN\PlatformBundle\Entity\Project;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse; //important use à déclarer pour l'utilisation de RedirectResponse
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class ImageController extends Controller
{


	public function menuAction($limit)
  	{
  		// On récupére les transcriptions dans la base de donnée
  		$repository = $this->getDoctrine()
		 	->getManager()
		 	->getRepository('PHuNPlatformBundle:Transcription')
		 ;
		
		 //On récupère l'entité correspondante à l'id $id
		 $transcription1 = $repository->find(3);		
		 $transcription2 = $repository->find(3);		
		 $transcription3 = $repository->find(3);		

	    // On fixe en dur une liste ici, bien entendu par la suite
	    // on la récupérera depuis la BDD !
	    $listTranscriptions = array(
	      $transcription1,
	      $transcription2,
	      $transcription3
	    );

	    return $this->render('PHuNPlatformBundle:Image:menu.html.twig', array(
	      // Tout l'intérêt est ici : le contrôleur passe es variables nécessaires au template !
	      'listTranscriptions' => $listTranscriptions
	    ));
  	}

	//test de viewAction avec récupération de la session et variables de session
	public function viewAction($id)
	{

		//$advert = array(
	    //'title'   => 'Recherche développpeur Symfony2',
	    //'id'      => $id,
	   // 'author'  => 'Alexandre',
	    //'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
	    //'date'    => new \Datetime()
	    //);

		 $repository = $this->getDoctrine()
		 	->getManager()
		 	->getRepository('PHuNPlatformBundle:Image')
		 ;
		
		 //On récupère l'entité correspondante à l'id $id
		 $advert = $repository->find($id);		

			

		// récupération de l'annonce correspondante à l'id $idss
		return $this->render('PHuNPlatformBundle:Image:view.html.twig', array('image' => $advert));
	}
}	