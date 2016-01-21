<?php

namespace PHuN\PlatformBundle\Controller;

use PHuN\PlatformBundle\Form\CorpusSetPluginsType;
use PHuN\PlatformBundle\Entity\Plugin;
use PHuN\PlatformBundle\Form\CorpusType;
use PHuN\PlatformBundle\Form\TranscriptionType;
use PHuN\PlatformBundle\Entity\Image;
use PHuN\PlatformBundle\Entity\Page;
use PHuN\PlatformBundle\Entity\Corpus;
use PHuN\PlatformBundle\Entity\Transcription;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse; //important use à déclarer pour l'utilisation de RedirectResponse
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class PageController extends Controller
{
		// Correspond to defaults: { _controller: PHuNPlatformBundle:Page:index } in routing.yml
	public function indexAction($page)
	{
		$repository = $this
		  ->getDoctrine()
		  ->getManager()
		  ->getRepository('PHuNPlatformBundle:Corpus')
		;

		$listCorpus = $repository->findAll();
		

		if ($page < 1){
			throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
		}

		return $this->render('PHuNPlatformBundle:Page:index.html.twig', array(
			'listCorpus' => $listCorpus
  			));
		
	}

		public function howAction()
	{
	

		return $this->render('PHuNPlatformBundle:Page:how.html.twig');
		
	}
	
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
	    $corpus = $page->getCorpus();
		 	
	    // Les plugins associés déjà au corpus
	    $arrayPlugins = $corpus->getPlugins();

	    $toolbar = "";
	    $menu1   = "";
	    $menu2   = "";
	    $menu3   = "";
	    $menu4   = "";
	    $menu4   = "";
	    $pluginList   = "";
	    foreach ($arrayPlugins as $plugin) {
	    	$arrayContainers = $plugin->getContainers();

	    	foreach ($arrayContainers as $container) {
	    		$containerId = $container->getId();
		    	if ($containerId == 1) {
		    		$toolbar = $toolbar . ' | ' . $plugin->getName();
		    	}
		    	if ($containerId == 2) {
		    		$menu1 = $menu1 . ' ' . $plugin->getName();
		    	}
		    	if ($containerId == 3) {
		    		$menu2 = $menu2 . ' ' . $plugin->getName();
		    	}
		    	if ($containerId == 4) {
		    		$menu3 = $menu3 . ' ' . $plugin->getName();
		    	}
		    	if ($containerId == 5) {
		    		$menu4 = $menu4 . ' ' . $plugin->getName();
		    	}
	    	}
	    	$pluginList = $pluginList . ' ' . $plugin->getName();
	    }

	    // Action lorsque l'utilisateur appuis sur save
	     if ($form->handleRequest($request)->isValid()) {
	     	$pageName = $page->getAlt();
	     	$folder_name = '../catalogue_xml/transcriptions/'.$pageName.'/';

	     	$transcription->setDate(new \Datetime());
	     	$transcription->setPage($page);
	     	$transcription->setUser($user);
	     	$transcription->setUrlXml("NULL");

	     	$em = $this->getDoctrine()->getManager();
	     	$em->persist($transcription);
	     	$em->flush();

	     	$userName = $user->getUsername();
	     	$content  = $transcription->getContent();
	     	$id 	  = $transcription->getId();

	     	$pathx_copyfile = $folder_name . $pageName . '_' . $id . '.xml';
	     	$transcription->setUrlXml($pathx_copyfile);
	     	$em->persist($transcription);
	     	$em->flush();

	     	$debut = "<contenu>";
	     	$fin   = "</contenu>";
	     	$filexml = $debut.$content.$fin;

	     	// Set folder url for transcription

	     	$find = array( "&nbsp;", "&agrave;", "&eacute;");
		    $repl = array( "", "à", "é");
		    $filexml = str_replace($find, $repl, $filexml);

	     	//on crée le répertoire pour le nouveau fichier s'il n'existe pas déjà
		    if (!file_exists($folder_name)) {
		    	mkdir($folder_name, 0755, true);
			}
	     	file_put_contents($pathx_copyfile, $filexml);

	     	/**********************************************************/
	     	//Transformation XSLT : HTML2XML
	     	$xmlDoc=new \DOMDocument();
    		$xmlDoc->load($pathx_copyfile);

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

	     	

	    	return $this->redirect($this->generateUrl('phun_platform_view', array('id' => $page->getId())));
    	} 		


		
		 $repository = $this->getDoctrine()
		 	->getManager()
		 	->getRepository('PHuNPlatformBundle:Container')
		 ;
		 $listContainers = $repository->findAll();

    	$tiny_conf ="
    		{{
			    tinymce_init({
			      'use_callback_tinymce_init': false,
			      'theme': {

			        'advanced': {
						'menu' : {
							'menu1' : {
								'title' : '" . $listContainers[1]->getName() . "',
								'items' : '" . $menu1 . "'
							},
							'menu2' : {
								'title' : '" . $listContainers[2]->getName() . "',
								'items' : '" . $menu2 . "'
							},
							'menu3' : {
								'title' : '" . $listContainers[3]->getName() . "',
								'items' : '" . $menu3 . "'
							},
							'menu4' : {
								'title' : '" . $listContainers[4]->getName() . "',
								'items' : '" . $menu4 . "'
							},
						},
			            'menubar': 'file menu1 menu2 menu3 menu4',
			            'entity_encoding': 'UTF-8',
    					'plugins': 'autoresize',
			            'plugins': '" . $pluginList . "',
			            'toolbar': '" . $toolbar . "',
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
	public function viewAction($id)
	{

		 $repository = $this->getDoctrine()
		 	->getManager()
		 	->getRepository('PHuNPlatformBundle:Page')
		 ;
		
		 //On récupère l'entité correspondante à l'id $id
		 $page = $repository->find($id);

		 	

		// La page est affichée
		return $this->render('PHuNPlatformBundle:Page:view.html.twig', array('page' => $page));
	}

	// Controlleur permettant de voir un ensemble de pages
	public function viewAllAction()
	{

		$repository = $this->getDoctrine()
	    	->getRepository('PHuNPlatformBundle:Page');

	    $myLimit = 201;
		$listPages = $repository->myFindLimited($myLimit);

		return $this->render('PHuNPlatformBundle:Page:view_all.html.twig', array('listPages' => $listPages));
	}



	public function menuAction()
	{
		$user = $this->getUser();

	    $repository = $this->getDoctrine()
		 	->getManager()
		 	->getRepository('PHuNPlatformBundle:Transcription')
		 ;

	    $listTranscriptions = $repository->findByUser($user);
		 //return new Response( $listTranscriptions);
	    

	    return $this->render('PHuNPlatformBundle:Page:menu.html.twig', array(
	      'listTranscriptions' => $listTranscriptions
	    ));
	}

	public function AddCorpusAction(Request $request)
	{
		// Vérification du statut d'admin de l'utilisateur accédant à la page
	    if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
	      // Sinon on déclenche une exception « Accès interdit »
	      throw new AccessDeniedException('Accès limité aux administrateurs d\'un projet.');
	    }

	    $repository = $this->getDoctrine()
		 	->getManager()
		 	->getRepository('PHuNPlatformBundle:Corpus')
		 	->findOneById(1);
		 ;

		$corpus =  $repository;

	    //$corpus = $repository->getId();
		//$corpus = new Corpus();
	    $form = $this->get('form.factory')->create(new CorpusType(), $corpus);

	    $corpus->setPluginList('');

	    if ($form->handleRequest($request)->isValid()) {

	    	$corpus->getImage()->upload();

	    	$em = $this->getDoctrine()->getManager();
	    	$em->persist($corpus);
	    	$em->flush();
	    	//$corpusId = $corpus->getId();
	    	$corpusId = $repository->getId();

	     	$request->getSession()->getFlashBag()->add('notice', 'Le projet a bien été créé.');

	        return $this->redirect($this->generateUrl('phun_platform_add_plugin', array('id' => $corpusId )));
	    }

	    return $this->render('PHuNPlatformBundle:Corpus:add_corpus.html.twig', array(
	      'form' => $form->createView()
	    ));

	}

	public function view_pluginsAction($id, Request $request)
	{
		// Vérification du statut d'admin de l'utilisateur accédant à la page
	    if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
	      // Sinon on déclenche une exception « Accès interdit »
	      throw new AccessDeniedException('Accès limité aux administrateurs d\'un projet.');
	    }


	    $em = $this->getDoctrine()->getManager();

	    // On récupère le corpus $id
	    $corpus = $em->getRepository('PHuNPlatformBundle:Corpus')->find($id);
	    $form = $this->get('form.factory')->create(new CorpusSetPluginsType(), $corpus);

	    // Les plugins associés déjà au corpus
	    $arrayPlugins = $corpus->getPlugins();

	    // La méthode findAll retourne toutes les catégories de la base de données
	    $listPlugins = $em->getRepository('PHuNPlatformBundle:Plugin')->findAll();

	    if ($form->handleRequest($request)->isValid()) {


	    	$em = $this->getDoctrine()->getManager();
	    	$em->persist($corpus);
	    	$em->flush();
	    	$corpusId = $corpus->getId();

	     	$request->getSession()->getFlashBag()->add('notice', 'L\'éditeur pour ce projet a été créé.');

	        return $this->redirect($this->generateUrl('phun_platform_view_editor', array('id' => $corpusId )));
	    }

	    

	    $em->flush();


	    return $this->render('PHuNPlatformBundle:Plugin:view_plugins.html.twig', array(
	      'id' => $id, 'arrayPlugins' => $arrayPlugins, 'listPlugins' => $listPlugins, 'form' => $form->createView()
 	    ));
	}

	// Fonction permettant de voir la page ayant comme id $id
	public function viewEditorAction($id)
	{

		 $repository = $this->getDoctrine()
		 	->getManager()
		 	->getRepository('PHuNPlatformBundle:Page')
		 ;
		
		 //On récupère l'entité correspondante à l'id $id
		 $page = $repository->find($id);

		 	

		// La page est affichée
		return $this->render('PHuNPlatformBundle:Page:view.html.twig', array('page' => $page));
	}


	public function p_pluginAction($id, Request $request)
	{
	    $em = $this->getDoctrine()->getManager();

	    // On récupère le corpus $id
	    $corpus = $em->getRepository('PHuNPlatformBundle:Corpus')->find($id);

	    if (null === $corpus) {
	      throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
	    }

	    // La méthode findAll retourne toutes les catégories de la base de données
	    $listPlugins = $em->getRepository('PHuNPlatformBundle:Plugin')->findAll();

	    // // On boucle sur les plugins pour les lier au corpus
	    // foreach ($listPlugins as $plugin) {
	    //   $corpus->addPlugin($plugin);
	    // }

	    // $em->flush();

	    return $this->redirect($this->generateUrl('phun_platform_view_plugins', array('id' => $id, 'listPlugins' => $listPlugins )));

	    // return $this->render('PHuNPlatformBundle:Plugin:view_plugins.html.twig', array(
	    //   'id' => $id
	    // ));
	}
}