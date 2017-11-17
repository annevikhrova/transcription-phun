<?php

namespace PHuN\PlatformBundle\Controller;

use PHuN\PlatformBundle\Editor\EditorConfig;
use PHuN\PlatformBundle\Form\CorpusType;
use PHuN\PlatformBundle\Form\TranscriptionType;
use PHuN\PlatformBundle\Entity\Image;
use PHuN\PlatformBundle\Entity\Page;
use PHuN\PlatformBundle\Entity\Comment;
use PHuN\PlatformBundle\Form\CommentType;
use PHuN\PlatformBundle\Controller\CommentController;
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
        $em = $this->getDoctrine()->getManager();
        // Repository de la table page
        $repository = $em->getRepository('PHuNPlatformBundle:Transcription');

        // On récupère la page correspondante à l'id $id
        $transcription = $repository->find($id);
        $page = $transcription->getPage();
        $corpusId = $page->getCorpus()->getId();

        $this->denyAccessUnlessGranted('ROLE_AUTEUR');
        // On récupére l'utilisateur qui transcrit
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

        // on tranforme et on enregistre dans un nouveau document XML
        $contenu =  $contenu->asXML();
        $contenu = str_replace("<contenu>", "", $contenu);
        $contenu = str_replace("</contenu>", "", $contenu);
        //$contenu = $xml.$contenu;

        // The transcription content is set to be seen in the form
        $transcription->setContent( $contenu ); // Ici, remplacement du $content_xml integral par $contenu (fichier sans descriptif)

        // Form creation for the transcription
        $form = $this->get('form.factory')->create(new TranscriptionType(), $transcription);


        // On récupère le corpus $id
        $corpus = $this->getDoctrine()
                    ->getManager()->getRepository('PHuNPlatformBundle:Corpus')->find($corpusId);

        $containerList = $this->getDoctrine()
            ->getManager()
            ->getRepository('PHuNPlatformBundle:Container')
            ->findAll();    
        //Chargement de l'éditeur paramétré :
        $listPlugins = $corpus->getPlugins();
        $stylesheet  = $corpus->getStylesheet()->getUrl();
        $editConfig = new EditorConfig($listPlugins, $stylesheet, $containerList);
        $tiny_conf = $editConfig->createEditorConfig();

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


    /**    END OF FORM CREATION AND HANDLING		**/
    /********************************************************/

    return $this->render('PHuNPlatformBundle:Transcription:edit.html.twig',
        array('page' => $page,
            'corpus' => $corpus,
            'form' => $form->createView(),
            'tiny_conf' => $tiny_conf,
            'listComments' => $commentArray["listComments"],
            'form_comment' => $commentArray['form_comment']->createView(),
            'transcription' => $transcription,
            'stylesheet' => $stylesheet

        ));
       //return new Response(var_dump($contenu_xml));

    }

    // Fonction permettant de voir la page ayant comme id $id
    public function listAction($id)
    {
            $id1 = "";
            $id2 = "";


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
                    'listTranscriptions' => $listTranscriptions,
                    'id1' => $id1, 
                    'id2' => $id2
            ));
    }

    public function selectAction($id1, $id2)
    {
        return new Response($id1, $id2);
    }

    // Fonction permettant de voir la page ayant comme id $id
    public function viewAction($id)
    {

             // $repository = $this->getDoctrine()
             // 	->getManager()
             // 	->getRepository('PHuNPlatformBundle:Transcription')
             // ;

             // //On récupère l'entité correspondante à l'id $id
             // $page = $repository->find($id);
             // $pageId = $page->getId();
             // $pageOriginal = $page->getPageId();

             //  $repository = $this->getDoctrine()
             // 	->getManager()
             // 	->getRepository('PHuNPlatformBundle:Page')
             // ;

             // $corpusId = $repository->find($pageOriginal)->getCorpusId();


              $repository = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('PHuNPlatformBundle:Transcription')
             ;

             $transcription = $repository->find($id);
             $page = $transcription->getPage();
             $corpus = $page->getCorpus();

             $stylesheet = $corpus->getStylesheet();

             $urlCSS = $stylesheet->getUrl();

             // $repository = $this->getDoctrine()
             // 	->getManager()
             // 	->getRepository('PHuNPlatformBundle:Page')
             // ;

             // $page = $repository->find($pageId);

             //$content_xml = $transcription->getContent();

             $listUsers = array();
             $listTranscriptions = $repository->findByPage($page);

             foreach( $listTranscriptions as $tr ) {
                 $listUsers[] = $tr->getUser();
             }
             $listUsers = array_unique($listUsers);
             $em = $this->getDoctrine()->getManager();
            $UserRepository = $em->getRepository('PHuNUserBundle:User');
            foreach( $listTranscriptions as $tr ) {
                 $rId1 = $tr->getUserRevision1();
                 $rId2 = $tr->getUserRevision2();
                 $rId3 = $tr->getUserRevision3();

                 $r1 = $UserRepository->findOneById($rId1);
                 $r2 = $UserRepository->findOneById($rId2);
                 $r3 = $UserRepository->findOneById($rId3);

             }


            return $this->render('PHuNPlatformBundle:Transcription:view.html.twig', array(
                    'page' => $page,
                    'corpus' => $corpus,
                    'transcription' => $transcription,
                    'urlCSS' => $urlCSS,
                    'listUsers' => $listUsers,
                    'r1'        => $r1,
                    'r2'        => $r2,
                    'r3'        => $r3
            ));
    }

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

    // Fonction permettant de voir la liste de toutes les transcriptions existantes pour un projet
    public function listAllTranscriptionsAction($corpusId, $userId)
    {

        //$userId = $id;
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('PHuNUserBundle:User')
        ;

        $user = $repository->find($userId);
        //$userStatus = $user->getStatus(); 


        // Doctrine accède à la table Transcription
        $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('PHuNPlatformBundle:Transcription')
        ;

        // On récupère toutes les enregistrements de la table
        $listTranscriptions = $repository->findAll();
        // On récupère les pages (.JPG) sources pour chacune des transcriptions
        foreach ($listTranscriptions as $transcription) {
                $page = $transcription->getPage();
                // On récupère le corpus
                $currentCorpusId = $page->getCorpus()->getId();

                if ($currentCorpusId == $corpusId) {
                        $listTranscriptionsDuCorpus[] = $transcription ; 
                }
        }
        return $this->render('PHuNPlatformBundle:Transcription:listAll.html.twig', array(
                'listTranscriptions' => $listTranscriptionsDuCorpus
        ));			 
    }

    // Fonction permettant de voir toutes les transcriptions en relecture
    public function listAllRevisionsAction($corpusId)
    {

        $user = $this->getUser();
        // Doctrine accède à la table Transcription
        $em = $this->getDoctrine()->getManager();	
        $repository = $em->getRepository('PHuNPlatformBundle:Transcription');
        $corpus = $em->getRepository('PHuNPlatformBundle:Corpus')->findOneById($corpusId);

        // On récupère toutes les enregistrements de la table
        $listRevisions = $repository->findBy(
            array('revision' => true),
            array('date' => 'ASC')
        );
        if ($listRevisions == null) {
            $listRevisionsDuCorpus = null;
        }
        else {
            // On récupère les pages (.JPG) sources pour chacune des transcriptions
            foreach ($listRevisions as $revision) {
                    $page = $revision->getPage();
                    // On récupère le corpus
                    $currentCorpusId = $page->getCorpus()->getId();

                    if ($currentCorpusId == $corpusId) {
                        $listRevisionsDuCorpus[] = $revision ;


                    }
                    else {
                         $listRevisionsDuCorpus = null;

                    }


            }
        }

        return $this->render('PHuNPlatformBundle:Transcription:listRevisions.html.twig', array(
                    'listRevisions' => $listRevisionsDuCorpus,
                    'corpus'        => $corpus,
                    'corpusId'      => $corpusId,

                    ));

    }
	


}	