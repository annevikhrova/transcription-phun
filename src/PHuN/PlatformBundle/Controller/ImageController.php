<?php

namespace PHuN\PlatformBundle\Controller;

use PHuN\PlatformBundle\Entity\Advert;
use PHuN\PlatformBundle\Entity\Application;
use PHuN\PlatformBundle\Entity\Image;
use PHuN\PlatformBundle\Entity\Transcription;
use PHuN\PlatformBundle\Entity\Project;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse; //important for RedirectResponse
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class ImageController extends Controller
{


	public function menuAction($limit)
  	{
  		// Recover all transcriptions in the database
  		$repository = $this->getDoctrine()
		 	->getManager()
		 	->getRepository('PHuNPlatformBundle:Transcription')
		 ;
		
		 // Recovery of entity corresponding to $id
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

		// Rendering of transcriptions in the menu
	    return $this->render('PHuNPlatformBundle:Image:menu.html.twig', array(
	      'listTranscriptions' => $listTranscriptions
	    ));
  	}

	public function viewAction($id)
	{
		 $repository = $this->getDoctrine()->getManager()->getRepository('PHuNPlatformBundle:Image');
		 // Recovery of entity corresponding to $id
		 $image = $repository->find($id);		
		// Rendering of image corresponding to $id
		return $this->render('PHuNPlatformBundle:Image:view.html.twig', array('image' => $image));
	}
}	