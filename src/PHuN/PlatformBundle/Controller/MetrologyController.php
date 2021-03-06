<?php

namespace PHuN\PlatformBundle\Controller;

use PHuN\PlatformBundle\Entity\Image;
use PHuN\PlatformBundle\Entity\Corpus;
use PHuN\PlatformBundle\Entity\Transcription;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse; //important for RedirectResponse
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class MetrologyController extends Controller
{

	/**
     * Choose second transcription
     * @param integer $id1
     * @return twig chooseSecondTranscription
     */
	public function chooseSecondTranscriptionAction($id1)
	{

		$repository = $this->getDoctrine()
		 	->getManager()
		 	->getRepository('PHuNPlatformBundle:Transcription')
		 ;

	    $transcription1 = $repository->findOneById($id1);
	    $page1 = $transcription1->getPage();
	    $listTranscriptions = $repository->findByPage($page1);
	    

	    return $this->render(
	    	'PHuNPlatformBundle:Metrology:chooseSecondTranscription.html.twig',
	    	array(
		    	'transcription1' => $transcription1,
		        'listTranscriptions' => $listTranscriptions,
	    ));

	}
	
	/**
     * Transcription comparison
	 * @param integer $id1
	 * @param integer $id2
     * @return twig view
     */
	public function compareAction($id1, $id2)
	{

		$repository = $this->getDoctrine()
		 	->getManager()
		 	->getRepository('PHuNPlatformBundle:Transcription')
		 ;

	    $transcription1 = $repository->findOneById($id1);
	    $transcription2 = $repository->findOneById($id2);
	    

	    return $this->render('PHuNPlatformBundle:Metrology:view.html.twig', array(
	      'transcription1' => $transcription1,
	      'transcription2' => $transcription2,
	    ));

	}

}