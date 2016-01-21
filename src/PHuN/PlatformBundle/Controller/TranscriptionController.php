<?php

namespace PHuN\PlatformBundle\Controller;


use PHuN\PlatformBundle\Form\CorpusType;
use PHuN\PlatformBundle\Form\TranscriptionType;
use PHuN\PlatformBundle\Entity\Image;
use PHuN\PlatformBundle\Entity\Page;
use PHuN\PlatformBundle\Entity\Corpus;
use PHuN\PlatformBundle\Entity\Plugin;
use PHuN\PlatformBundle\Entity\Transcription;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse; //important use à déclarer pour l'utilisation de RedirectResponse
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class TranscriptionController extends Controller
{
	// Fonction permettant de faire une transcription de la page $id
	public function editAction($id, Request $request)
	{
		// Repository de la table page
		 $repository = $this->getDoctrine()
		 	->getManager()
		 	->getRepository('PHuNPlatformBundle:Page')
		 ;
		
		 // On récupère la page correspondante à l'id $id
		 $page = $repository->find($id);

		 // On récupére l'utilisateur qui transcrit
		 $user = $this->getUser();

		 $transcription = new Transcription();
		
		 $content_xml = file_get_contents(substr($page->getUrlXml(),15));


		 // TRANSFORMATION XSL DU XML VERS LE HTML

		 // The transcription content is set to be seen in the form
		 $transcription->setContent( $content_xml );

		 // Form creation for the transcription
    	 $form = $this->get('form.factory')->create(new TranscriptionType(), $transcription);


	    // On récupère le corpus $id
	    $corpus = $this->getDoctrine()
		 	->getManager()->getRepository('PHuNPlatformBundle:Corpus')->find(5);
		 	
	    // Les plugins associés déjà au corpus
	    $arrayPlugins = $corpus->getPlugins();

	    $tiny_pluginList = "";
	    $tiny_toolbarList = "";
	    $i = 1;
	    foreach ($arrayPlugins as $plugin) {
	    	$pluginName = $plugin->getName();
	    	$tiny_pluginList = $tiny_pluginList . ' ' . $pluginName;
	    	$tiny_toolbarList = $tiny_toolbarList . ' | ' . $pluginName;
	    }

	     if ($form->handleRequest($request)->isValid()) {
	     	$transcription->setDate(new \Datetime());
	     	$transcription->setPage($page);
	     	$transcription->setUser($user);

	     	$em = $this->getDoctrine()->getManager();

	     	$em->persist($transcription);
	     	$em->flush();

	     	$userName = $user->getUsername();
	     	$pageName = $page->getAlt();
	     	$content  = $transcription->getContent();
	     	$id 	  = $transcription->getId();

	     	$folder_name = '../catalogue_xml/transcriptions/'.$pageName.'/';

	     	$debut = "<contenu>";
	     	$fin   = "</contenu>";
	     	$filexml = $debut.$content.$fin;
	     	$pathx_copyfile = $folder_name . $pageName . '_' . $id . '_copy.xml';

	     	$find = array( "&nbsp;", "&agrave;", "&eacute;");
		    $repl = array( "", "à", "é");
		    $filexml = str_replace($find, $repl, $filexml);

	     	//on crée le répertoire pour le nouveau fichier s'il n'existe pas déjà
		    if (!file_exists($folder_name)) {
		    	mkdir($folder_name, 0755, true);
			}
	     	file_put_contents($pathx_copyfile, $filexml);

	     	
	     	//$xmlFileName = $userName . '/' . $pageName . '.xml';

	     	$xmlDoc=new \DOMDocument();
    		$xmlDoc->load($pathx_copyfile);

	     	/**********************************************************/
	     	//Transformation XSLT : HTML2XML

	     	$xsltDoc = new \DOMDocument();
		    $xsltDoc->load("xsl/xsl_gen/html2xml.xsl");

		        // Chargement du processeur et import de la feuille de style
		    $xslt = new \XSLTProcessor();
		    $xslt->importStylesheet($xsltDoc);

		        // on tranforme et on enregistre dans un nouveau document XML
		    $result = $xslt->transformToDoc($xmlDoc); 

    		$result_name = $folder_name . $pageName . '_' . $id . '.xml';
    		$result->save($result_name);

			//FIN PROCESSUS XSLT
			/***************************************************************/

	     	

	    	return $this->redirect($this->generateUrl('phun_platform_transcription_view', array('id' => $page->getId())));
    	} 		

    	$tiny_conf ="
    		{{
			    tinymce_init({
			      'use_callback_tinymce_init': true,
			      'theme': {
			        'advanced': {
			            'menubar': false,
    					'plugins': 'autoresize',
			            'plugins': '" . $tiny_pluginList . "',
			            'toolbar': '" . $tiny_toolbarList . "',
			        }
			      }
			    })
			}}
		 ";

		return $this->render('PHuNPlatformBundle:Page:edit.html.twig',
			array('page' => $page,
				  'form' => $form->createView(),
				  'tiny_conf' => $tiny_conf
				  ));

	}

	// Fonction permettant de voir la page ayant comme id $id
	public function listAction($id)
	{

		 $repository = $this->getDoctrine()
		 	->getManager()
		 	->getRepository('PHuNPlatformBundle:Page')
		 ;
		
		 //On récupère l'entité correspondante à l'id $id
		 $page = $repository->find($id);
		 $pageId = $page->getId();

		  $repository = $this->getDoctrine()
		 	->getManager()
		 	->getRepository('PHuNPlatformBundle:Transcription')
		 ;

		 //$transcription = $repository->find($user->get)
		 $listTranscriptions = $repository->findBy(
		  array('page' => $pageId)                              // Offset
		);	

		// La page est affichée
		return $this->render('PHuNPlatformBundle:Transcription:list.html.twig', array(
			'page' => $page, 
			'listTranscriptions' => $listTranscriptions
		));
	}

	// Fonction permettant de voir la page ayant comme id $id
	public function viewAction($id)
	{

		 $repository = $this->getDoctrine()
		 	->getManager()
		 	->getRepository('PHuNPlatformBundle:Page')
		 ;
		
		 //On récupère l'entité correspondante à l'id $id
		 $page = $repository->find($id);
		 $pageId = $page->getId();

		  $repository = $this->getDoctrine()
		 	->getManager()
		 	->getRepository('PHuNPlatformBundle:Transcription')
		 ;

		 $transcription = $repository->find($id);

		 $content_xml = $transcription->getContent();
		 $content_html;


		return $this->render('PHuNPlatformBundle:Transcription:view.html.twig', array(
			'page' => $page, 
			'transcription' => $transcription
		));
	}

}	