<?php

namespace PHuN\PlatformBundle\Controller;

use PHuN\PlatformBundle\Editor\EditorConfig; 
use PHuN\PlatformBundle\Form\CorpusType;
use PHuN\PlatformBundle\Form\TranscriptionType;
use PHuN\PlatformBundle\Entity\Image;
use PHuN\PlatformBundle\Entity\Page;
use PHuN\PlatformBundle\Entity\Comment;
use PHuN\PlatformBundle\Form\CommentType;
use PHuN\PlatformBundle\Entity\Corpus;
use PHuN\PlatformBundle\Entity\Plugin;
use PHuN\PlatformBundle\Entity\Transcription;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse; //important for RedirectResponse
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class RevisionController extends Controller
{
    /**
     * Function allowing to edit a transcription for page $id
     * @param integer $id Unique of transcription
     * @param Request $request
     * @return twig containing editor interface and view of a page
     */
	public function editAction($id, Request $request)
	{
            $em = $this->getDoctrine()->getManager();
            // Transcription repository
            $repository = $this->getDoctrine()->getManager()->getRepository('PHuNPlatformBundle:Transcription');

            // Recover transcription corresponding to $id, page, and corpus id
            $transcription = $repository->find($id);
            $page = $transcription->getPage();
            $corpusId = $page->getCorpus()->getId();

            // Get user
            $user = $this->getUser();
            
            $url_xml = $transcription->getUrlXml(); 
            if (is_file($url_xml) == null) {
                    $contenu_xml = simplexml_load_file("transcriptionMinimal.xml");
            }
            else {
                $contenu_xml = simplexml_load_file($url_xml);
            }        
                  
            $contenu = $contenu_xml->contenu;
            $xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
           
            // Transformation of content and save as new XML file
            $contenu =  $contenu->asXML();
            $contenu = str_replace("<contenu>", "", $contenu);
            $contenu = str_replace("</contenu>", "", $contenu);
            
            // The transcription content is set to be seen in the form
            $transcription->setContent( $contenu ); // Ici, remplacement du $content_xml integral par $contenu (fichier sans descriptif)

            // Form creation for the transcription
            $form = $this->get('form.factory')->create(new TranscriptionType(), $transcription);
            
	        // Get corpus by $id to find associated stylesheet
	        $corpus = $this->getDoctrine()->getManager()->getRepository('PHuNPlatformBundle:Corpus')->find($corpusId);
            $stylesheet  = $corpus->getStylesheet()->getUrl();
            // Get editor configuration
            $tiny_config_file = "corpus/config/editor_". $corpus->getName(). ".json";
            $tiny_conf = file_get_contents($tiny_config_file);
                                    
            /**
            * Calls CommentController function viewCommentsAction used to recover all comments for page
            */
            $commentController = new CommentController($em);
            $formFactory = $this->get('form.factory');
            $commentArray = $commentController->viewCommentsAction($id, $user, $formFactory, $request);
        		
            // Action when user saves and exits transcription
            if ( $form->handleRequest($request)->isValid() )
            {   
                if ($form->get('save_exit')->isClicked()) {

                    return $this->saveAndExit( $page, $user, $transcription, $corpus, $stylesheet, $form );

                }
                // If user saves transcription to continue working 
                else if($form->get('save')->isClicked()) {

                    return $this->simpleSave ( $page, $user, $transcription, $corpus, $stylesheet, $form, $tiny_conf, $commentArray );
                }

            }

	/**    END OF FORM CREATION AND HANDLING		        **/
	/********************************************************/

	return $this->render('PHuNPlatformBundle:Revision:edit_revision.html.twig',
            array('page' => $page,
                'corpus' => $corpus,
            'form' => $form->createView(),
            'tiny_conf' => $tiny_conf,
            'listComments' => $commentArray['listComments'],
            'form_comment' => $commentArray['form_comment']->createView(),
            'transcription' => $transcription
            ));
	}

    /** Function to view a transcription in revision by transcription $id */
	public function viewRevisionAction($id)
	{                
		$em = $this->getDoctrine()->getManager();	
        $repository = $em->getRepository('PHuNPlatformBundle:Transcription');

		$transcription = $repository->find($id);
		$page = $transcription->getPage();
		$corpus = $page->getCorpus();
                
        $listUsers = array();
        $listTranscriptions = $repository->findByPage($page);
                 
        foreach( $listTranscriptions as $tr ) {
            $listUsers[] = $tr->getUser();
        }
                
        $listUsers = array_unique($listUsers);

		$stylesheet = $corpus->getStylesheet();

		$urlCSS = $stylesheet->getUrl();
                
        $UserRepository = $em->getRepository('PHuNUserBundle:User');
        foreach( $listTranscriptions as $tr ) {
            $rId1 = $tr->getUserRevision1();
            $rId2 = $tr->getUserRevision2();
            $rId3 = $tr->getUserRevision3();
                     
            $r1 = $UserRepository->findOneById($rId1);
            $r2 = $UserRepository->findOneById($rId2);
            $r3 = $UserRepository->findOneById($rId3);         
        }
                 
        $listUsers = array_diff($listUsers, [$r1, $r2, $r3]);
                 
		return $this->render('PHuNPlatformBundle:Revision:viewRevision.html.twig', array(
			'transcription' => $transcription,
			'urlCSS' => $urlCSS,
                        'corpus' => $corpus,
                        'listUsers' => $listUsers,
                        'r1'        => $r1,
                        'r2'        => $r2,
                        'r3'        => $r3
		));
	}	

	// Fonction permettant de voir la transcription ayant comme id $id
	public function confirmAction($id, $corpusId)
	{
        $user = $this->getUser();
		$em = $this->getDoctrine()->getManager();

		$repository = $em->getRepository('PHuNPlatformBundle:Transcription');

		$transcription = $repository->findOneById($id);
		$page = $transcription->getPage();
		$corpus = $page->getCorpus();

		$nbRevisions = $transcription->getNbRevisions();

		
                if ($nbRevisions == 0) {
                    $confirmNbRevisions = $nbRevisions +1;
                    $transcription->setNbRevisions($confirmNbRevisions);
                    $transcription->setUserRevision1($user);

                }
                else if ($nbRevisions == 1) {
                    $confirmNbRevisions = $nbRevisions +1;
                    $transcription->setNbRevisions($confirmNbRevisions);
                    $transcription->setUserRevision2($user);

                }
                else if ($nbRevisions == 2) {
                    $confirmNbRevisions = $nbRevisions +1;
                    $transcription->setNbRevisions($confirmNbRevisions);
                    $transcription->setUserRevision3($user);

                }
                else if ($nbRevisions == 3) {
                    $transcription->setPublished(true);
                    $transcription->setRevision(false);

                    $em->persist($transcription);
                    $em->flush();

                    $page = $transcription->getPage();
                    $statusPublished = $transcription->getPublished();
                    $transcription_url_xml = $transcription->getUrlXml();
                    $transcription_id = $transcription->getId();

                    $page->setPublished($statusPublished);
                    $page->setUrlXml($transcription_url_xml);
                    $page->setIdPublishedTranscription($transcription_id);

                    $em->persist($page);
                    $em->flush();
                }  
			
                $em->persist($transcription);
                $em->flush();
 

		// On récupère toutes les enregistrements de la table
		$listRevisions = $repository->findBy(
		    array('revision' => true),
		    array('date' => 'ASC')
		);
		// On récupère les pages (.JPG) sources pour chacune des transcriptions
		foreach ($listRevisions as $revision) {
			$page = $revision->getPage();
			// On récupère le corpus
		 	$currentCorpusId = $page->getCorpus()->getId();

		 	if ($currentCorpusId == $corpusId) {
		 		$listRevisionsDuCorpus[] = $revision ; 
			}
		}

        //return new Response($userId);
		return $this->render('PHuNPlatformBundle:Revision:status.html.twig', array(
			'page' => $page,
                        'corpus' => $corpus,
			'transcription' => $transcription,
			'corpusId' => $corpusId
			//'listRevisions' => $listRevisionsDuCorpus
		));
	}
    
    /**
     * Save and exit function. One of two types of save functions
     * @param Page $page
     * @param User $user
     * @param Transcription $transcription
     * @param Corpus $corpus
     * @param Stylesheet $stylesheet
     * @param Form $form
     */
    public function saveAndExit( $page, $user, $transcription, $corpus, $stylesheet, $form ) {
        // Redirect to view the newly saved page
        $pageName       = $page->getFileName();
        $corpusName     = $corpus->getName();
        $corpusId       = $corpus->getId();
        $folder_name    = 'corpus/'.$corpusName.'_'.$corpusId.'/transcriptions/'.$pageName.'/';


        $newTranscription = $transcription;
        $newTranscription->setDate(new \Datetime());
                $newTranscription->setPage( $transcription->getPage() );
                $newTranscription->setUser( $user );
                $newTranscription->setContent( $transcription->getContent() );
        $newTranscription->setUrlXml("NULL");
        $newTranscription->setPublished(false);

        //$newTranscription->setNbRevisions(-1);

        if ($form['revision']->getData() == false) {
                $newTranscription->setNbRevisions(-1);
                $newTranscription->setPublished(false);
        }

        if ($form['revision']->getData() == true) {
                $nbRevisions = $newTranscription->getNbRevisions()+ 1;
                //$nbRevisions = $nbRevisions + 1;
                $transcription->setRevision(true);
                $newTranscription->setNbRevisions($nbRevisions); 
                $newTranscription->setPublished(false);


                if ($form['revision']->getData() == true && $newTranscription->getNbRevisions() == 3) {
                        $newTranscription->setPublished(true);
                        $newTranscription->setRevision(false);
                }
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($newTranscription);
        $em->flush();

        $userName = $user->getUsername();
        $content  = $newTranscription->getContent();
        $id       = $newTranscription->getId();

        $pathx_copyfile = $folder_name . $pageName . '_' . $id . '.xml';
        $newTranscription->setUrlXml($pathx_copyfile);
        $em->persist($newTranscription);
        $em->flush();
        
        
        $xmlHeader = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
        $debut = "<page><contenu>";
        $fin   = "</contenu></page>";
        $filexml = $xmlHeader.$debut.$content.$fin;

        // Create folder for new file if it doesn't already exist 
        if (!file_exists($folder_name)) {
            mkdir($folder_name, 0755, true);
        }
        // Write file to folder
        file_put_contents($pathx_copyfile, $filexml);

        return $this->redirect($this->generateUrl('phun_platform_transcription_view', array(
                'id' => $id,
                'corpus' => $corpus,
                'transcription' =>$transcription,
                'stylesheet' => $stylesheet
        )));
    }

    /**
     * Simple save function. User does not leave the page with this type of save
     * @param Page $page
     * @param User $user
     * @param Transcription $transcription
     * @param Corpus $corpus
     * @param Stylesheet $stylesheet
     * @param Form $form
     * @param string $tiny_conf
     * @param array $commentArray
     */
    public function simpleSave( $page, $user, $transcription, $corpus, $stylesheet, $form, $tiny_conf, $commentArray ) {
        // Persist transcription
        $newTranscription = $transcription;
        $em = $this->getDoctrine()->getManager();
        $em->persist($newTranscription);

        // Reload saved transcription 
        $form = $this->get('form.factory')->create(new TranscriptionType(), $newTranscription);

        return $this->render('PHuNPlatformBundle:Page:edit.html.twig',
            array(  'page' => $page,
                    'corpus' => $corpus,
                    'form' => $form->createView(),
                    'tiny_conf' => $tiny_conf,
                    'listComments' => $commentArray["listComments"],
                    'form_comment' => $commentArray['form_comment']->createView(),
                    'stylesheet' => $stylesheet
        ));
    }
 
    public function statusAction($id) {
        $em = $this->getDoctrine()->getManager();
        // Transcription repository
        $repository = $this->getDoctrine()->getManager()->getRepository('PHuNPlatformBundle:Transcription');

        // Recovery of transcription by $id
        $transcription = $repository->find($id);
        $page = $transcription->getPage();
        $corpus = $page->getCorpus();
        $corpusId = $page->getCorpus()->getId();
                
        return $this->render('PHuNPlatformBundle:Revision:status.html.twig', array(
            'page'      => $page,
            'corpus'    => $corpus,
            'corpusId'  => $corpusId,
            'id'        => $id,
            'transcription' => $transcription
            )
        );
    }
    
    /**
     * Verify that the user has not revised this transcription before
     * @param integer $id Unique transcription
     * @param integer $corpusId
     * @param bool $confirm
     * @param Request $request
     */
    public function notSameUserAction($id, $corpusId, $confirm, Request $request){
        $user = $this->getUser();  
        $em = $this->getDoctrine()->getManager();
        // Repository de la table transcription
        $repository = $this->getDoctrine()->getManager()->getRepository('PHuNPlatformBundle:Transcription');
        // On récupère la page correspondante à l'id $id
        $transcription = $repository->find($id);
        $page = $transcription->getPage();
        $corpus = $page->getCorpus();
        $listUsers = array();
        $listTranscriptions = $repository->findByPage($page);
                 
        foreach( $listTranscriptions as $transcription ) {
            $listUsers[] = $transcription->getUser();
        }
        $listUsers = array_unique($listUsers);
            
        if( $transcription->getUserRevision1() != NULL ) {
            $listUsers[] = $transcription->getUserRevision1();
        }
        if( $transcription->getUserRevision2() != NULL ) {
            $listUsers[] = $transcription->getUserRevision2();
        }
        if( $transcription->getUserRevision3() != NULL ) {
            $listUsers[] = $transcription->getUserRevision3();
        }
            
        if( !in_array($user, $listUsers) && $confirm == "false" ) {
                
        return $this->editAction($id, $request); 
        //return new Response ($user . "; user ");
        }else if( !in_array($user, $listUsers) && $confirm == "true" ){
            return $this->confirmAction($id, $corpusId); 
        }else {
            return $this->render('PHuNPlatformBundle:Revision:denied.html.twig', array('corpus'    => $corpus, 'corpusId' => $corpusId));
        }
            
        return new Response(" ");
    }
        
}       