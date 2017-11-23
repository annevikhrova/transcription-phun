<?php

namespace PHuN\PlatformBundle\Controller;

use PHuN\PlatformBundle\Editor\EditorConfig; 
use PHuN\PlatformBundle\Form\SousDossierType;
use PHuN\PlatformBundle\Entity\SousDossier;
use PHuN\PlatformBundle\Form\DossierType;
use PHuN\PlatformBundle\Entity\Dossier;
use PHuN\PlatformBundle\Form\CatalogueType;
use PHuN\PlatformBundle\Entity\Catalogue;
use PHuN\PlatformBundle\Form\CorpusSetPluginsType;
use PHuN\PlatformBundle\Entity\Plugin;
use PHuN\PlatformBundle\Form\CorpusType;
use PHuN\PlatformBundle\Form\TranscriptionType;
use PHuN\PlatformBundle\Entity\Image;
use PHuN\PlatformBundle\Entity\Page;
use PHuN\PlatformBundle\Controller\CommentController;
use PHuN\PlatformBundle\Entity\Comment;
use PHuN\PlatformBundle\Form\CommentType;
use PHuN\PlatformBundle\Entity\Corpus;
use PHuN\PlatformBundle\Entity\Transcription;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse; //important use for RedirectResponse
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use Symfony\Component\HttpFoundation\JsonResponse;

class PageController extends Controller
{
    
    /**
     * Displays all projects/corpora currently in the database 
     * @return twig view of corpus index page 
     */
    public function indexAction()
    {
        $repository = $this
          ->getDoctrine()
          ->getManager()
          ->getRepository('PHuNPlatformBundle:Corpus')
        ;

        $listCorpus = $repository->findAll();

        return $this->render('PHuNPlatformBundle:Page:index.html.twig', array(
            'listCorpus' => $listCorpus
        ));

    }
    
    /**
     * 
     * @return list of corpus items to be shown
     */
    public function corpusListAction()
    {
        $repository = $this
          ->getDoctrine()
          ->getManager()
          ->getRepository('PHuNPlatformBundle:Corpus')
        ;

        $listCorpus = $repository->findAll();

        return $this->render('PHuNPlatformBundle:Page:corpus_list.html.twig', array(
            'listCorpus' => $listCorpus
        ));

    }
        
    /**
     * Opens About page
     * @return twig view of About page
     */
    public function howAction()
    {

        return $this->render('PHuNPlatformBundle:Page:how.html.twig');

    }


    /**
     * Opens editor allowing to transcribe a selected page $id
     * @param integer $id Unique id of the page to be transcribed
     * @param Request $request
     * @return twig containing editor interface and view of a page
     */
    public function editAction($id, Request $request)
    {
        // Preparation of Doctrine, Manager and wanted repository
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('PHuNPlatformBundle:Page');

        // Recovery of page corresponding to $id
        $page = $repository->find($id);
        // Get information pertaining to corpus
        $corpus = $page->getCorpus();
        $corpusName = $corpus->getName();
        $corpusId = $corpus->getId();
        // Deny access to anyone not having an author role in the db
        $this->denyAccessUnlessGranted('ROLE_AUTEUR');
        // Get current user
        $user = $this->getUser(); 
        // Prepare xml prologue and setup xml file to be transcribed
        $xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
        $url_xml = $page->getUrlXml();
        //Check if file at $url_xml already exists and if not setup main content tag to contain transcription
        if (is_file($url_xml) == null){
            $contenu_xml = simplexml_load_file("transcriptionMinimal.xml");
            $contenu = $contenu_xml->contenu;
            $contenu = $contenu->asXML();
            $contenu = str_replace("<contenu>", "", $contenu);
            $contenu = str_replace("</contenu>", "", $contenu);
        }        

        else {
            $contenu_xml = simplexml_load_file($url_xml);
            $contenu = $contenu_xml->contenu;
            $init1 = '<table id="page-layout" style="background-color:#fff;" width="560" height="400"><tbody><tr><td width="17%"></td><td width="66%">';
            $init2 = '</td><td width="17%"></td></tr></tbody></table>';
            $contenu = $contenu->asXML();
            $contenu = str_replace("<contenu>", "", $contenu);
            $contenu = str_replace("</contenu>", "", $contenu);
        }     

        $transcription = new Transcription();
        $transcription->setContent( $contenu );

        // Form creation for the transcription
        $form = $this->get('form.factory')->create(new TranscriptionType(), $transcription);

        $stylesheet  = $corpus->getStylesheet()->getUrl();
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

    /**    END OF EDIT PAGE FORM CREATION AND HANDLING		**/
    /********************************************************/

    // Displays editor and view of chosen page along with associated resources
    return $this->render('PHuNPlatformBundle:Page:edit.html.twig',
            array(  'page' => $page,
                    'form' => $form->createView(),
                    'tiny_conf' => $tiny_conf,
                    'listComments' => $commentArray["listComments"],
                    'form_comment' => $commentArray['form_comment']->createView(),
                    'corpus'       => $corpus,
                    'stylesheet' => $stylesheet
            ));

    }



    /**
     * Displays view of page corresponding to $id
     * @param integer $id
     * @return twig view of selected page or published transcription
     */
    public function viewAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('PHuNPlatformBundle:Page')
        ;

        // Recovery of page corresponding to $id
        $page = $repository->find($id);
        $corpus = $page->getCorpus();
        $corpusName = $corpus->getName();

        $url_xml = $page->getUrlXml();

        $stylesheet = $corpus->getStylesheet();

        $urlCSS = $stylesheet->getUrl();


        if (!is_file($url_xml) == null)
        {
            if ($page->getPublished() == 0)
            {
                $content_xml = simplexml_load_file($url_xml);
                $contenu = $content_xml->contenu;

                $xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
                $contenu = $contenu->asXML();
                $contenu = $xml.$contenu;
                $urlXml = 'corpus/'.$corpusName.'/html/'.$page->getFileName().'.xml';

            $saveContenu = file_put_contents($urlXml, $contenu);
            }

            else if ($page->getPublished() == 1)
            {
            $id_published_transcription = $page->getIdPublishedTranscription();


                    $repository = $this->getDoctrine()
                            ->getManager()
                            ->getRepository('PHuNPlatformBundle:Transcription')
                    ;

                    $transcription = $repository->find( $id_published_transcription );
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
        }
        else {
            $content_xml = simplexml_load_file("transcriptionMinimal.xml");
            $contenu = $content_xml->contenu;

            $xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>";
            $contenu = $contenu->asXML();
            $contenu = $xml.$contenu;
            $urlXml = "transcriptionMinimal.xml";
        }
        
        $listUsers = array();
        
        // Display page
        return $this->render('PHuNPlatformBundle:Page:view.html.twig',
            array('page' => $page, 
                  'urlXml' => $urlXml, 
                  'urlCSS' => $urlCSS,
                  'corpus' => $corpus,
                  'listUsers' => $listUsers
                ));

    }

    /**
     * Creates new user comment
     * @param integer $id for page
     * @param Request $request
     * @return twig newComment
     */
    public function newCommentAction($id, Request $request)
    {
        // On récupére l'utilisateur qui écrit le commentaire
        $user = $this->getUser();

        $comment = new Comment();
        // Form creation for comment
        $form_comment = $this->get('form.factory')->create(new CommentType(), $comment);



        if( $form_comment->isSubmitted() && $form_comment->isValid() ) {
            return new Response ('Test');
            $comment->setUser($user);
            $comment->setPage($id);
            $comment->setDateTime(new \Datetime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();


        }    

        return $this->render('PHuNPlatformBundle:Page:newComment.html.twig',
            array(
                'form_comment' => $form_comment->createView()
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


        $transcription->setDate(new \Datetime());
        $transcription->setPage($page);
        $transcription->setUser($user);
        $transcription->setUrlXml("NULL");
        $transcription->setPublished(false);
        $transcription->setRevision(false);

        // Check if user checks box to send transcription into revision cycle : false
        if ($form['revision']->getData() == false) {
                    $transcription->setNbRevisions(-1);
                    $transcription->setPublished(false);
            }
        // revision cycle : true    
        if ($form['revision']->getData() == true) {
            $transcription->setRevision(true);
            $transcription->setNbRevisions(0); 
            $transcription->setPublished(false);

            if ($form['revision']->getData() == true && $transcription->getNbRevisions() == 3) {
                    $transcription->setPublished(true);
                    $transcription->setRevision(false);
            }
        }

        $em = $this->getDoctrine()->getManager();
        $em->persist($transcription);
        $em->flush();

        $userName = $user->getUsername();
        $content  = $transcription->getContent();
        $id       = $transcription->getId();

        $pathx_copyfile = $folder_name . $pageName . '_' . $id . '.xml';
        $transcription->setUrlXml($pathx_copyfile);
        $em->persist($transcription);
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
        $em = $this->getDoctrine()->getManager();
        $em->persist($transcription);

        // Reload saved transcription 
        $form = $this->get('form.factory')->create(new TranscriptionType(), $transcription);

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

    public function translationAction($name)
    {
        return $this->render('PHuNPlatformBundle:Page:translation.html.twig', array(
          'name' => $name
        ));
    }

}