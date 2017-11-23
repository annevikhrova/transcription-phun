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
use Symfony\Component\HttpFoundation\RedirectResponse; //important use for RedirectResponse
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class TranscriptionController extends Controller
{
    /**
     * Opens editor allowing to edit a selected transcription by $id
     * @param integer $id Unique id of the page to be transcribed
     * @param Request $request
     * @return twig containing editor interface and view of a page
     */
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        // Transcription repository
        $repository = $em->getRepository('PHuNPlatformBundle:Transcription');

        // Recovery of transcription by $id
        $transcription = $repository->find($id);
        $page = $transcription->getPage();
        $corpusId = $page->getCorpus()->getId();

        $this->denyAccessUnlessGranted('ROLE_AUTEUR');
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

        // Transform and save into a new XML file
        $contenu =  $contenu->asXML();
        $contenu = str_replace("<contenu>", "", $contenu);
        $contenu = str_replace("</contenu>", "", $contenu);

        // The transcription content is set to be seen in the form
        $transcription->setContent( $contenu ); // Ici, remplacement du $content_xml integral par $contenu (fichier sans descriptif)

        // Form creation for the transcription
        $form = $this->get('form.factory')->create(new TranscriptionType(), $transcription);

        // Recover corpus by $id
        $corpus = $this->getDoctrine()->getManager()->getRepository('PHuNPlatformBundle:Corpus')->find($corpusId);

        $containerList = $this->getDoctrine()->getManager()->getRepository('PHuNPlatformBundle:Container')->findAll();    
        // Editor configuration
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
            // If user saves transcription to continues working 
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

    }


    /**
     * Displays view of transcription corresponding to $id
     * @param integer $id
     * @return twig view of selected transcription
     */
    public function viewAction($id)
    {

        $repository = $this->getDoctrine()->getManager()->getRepository('PHuNPlatformBundle:Transcription');

        $transcription = $repository->find($id);
        $page = $transcription->getPage();
        $corpus = $page->getCorpus();
        $stylesheet = $corpus->getStylesheet();
        $urlCSS = $stylesheet->getUrl();

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

        if ($form['revision']->getData() == false) {
            $newTranscription->setNbRevisions(-1);
            $newTranscription->setPublished(false);
        }

        if ($form['revision']->getData() == true) {
            $nbRevisions = $newTranscription->getNbRevisions()+ 1;
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

    // Fonction permettant de voir la liste de toutes les transcriptions existantes pour un projet
    /**
     * Displays all transcriptions for corpus
     * @param integer $corpusId
     * @param integer $userId
     * @return twig listAll
     */
    public function listAllTranscriptionsAction($corpusId, $userId)
    {

        $repository = $this->getDoctrine()->getManager()->getRepository('PHuNUserBundle:User');
        $user = $repository->find($userId);

        // Transcription repository
        $repository = $this->getDoctrine()->getManager()->getRepository('PHuNPlatformBundle:Transcription');

        // Recover all listings in table
        $listTranscriptions = $repository->findAll();
        // Recover all associated pages for transcription list
        foreach ($listTranscriptions as $transcription) {
                $page = $transcription->getPage();
                // Recover corpus id
                $currentCorpusId = $page->getCorpus()->getId();

                if ($currentCorpusId == $corpusId) {
                        $listTranscriptionsDuCorpus[] = $transcription ; 
                }
        }
        return $this->render('PHuNPlatformBundle:Transcription:listAll.html.twig', array(
                'listTranscriptions' => $listTranscriptionsDuCorpus
        ));			 
    }

    /**
     * Displays all transcriptions in revision
     * @param integer $corpusId
     * @return twig listRevisions
     */
    public function listAllRevisionsAction($corpusId)
    {
        $user = $this->getUser();
        // Transcription repository
        $em = $this->getDoctrine()->getManager();	
        $repository = $em->getRepository('PHuNPlatformBundle:Transcription');
        $corpus = $em->getRepository('PHuNPlatformBundle:Corpus')->findOneById($corpusId);

        // Recover all listings
        $listRevisions = $repository->findBy(
            array('revision' => true),
            array('date' => 'ASC')
        );
        if ($listRevisions == null) {
            $listRevisionsDuCorpus = null;
        }
        else {
            // Recover all associated pages for revision list
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