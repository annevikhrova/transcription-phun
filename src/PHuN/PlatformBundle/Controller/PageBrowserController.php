<?php

namespace PHuN\PlatformBundle\Controller;

use PHuN\PlatformBundle\Form\SousDossierType;
use PHuN\PlatformBundle\Entity\SousDossier;

use PHuN\PlatformBundle\Form\DossierType;
use PHuN\PlatformBundle\Entity\Dossier;

use PHuN\PlatformBundle\Form\CatalogueType;
use PHuN\PlatformBundle\Entity\Catalogue;

use PHuN\PlatformBundle\Form\CorpusType;
use PHuN\PlatformBundle\Entity\Corpus;

use PHuN\PlatformBundle\Entity\Page;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class PageBrowserController extends Controller
{

    
    // Count the number of page in a corpus and make
    // the appropriate browsing redirection
    public function countAction(Request $request, $corpusId)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('PHuNPlatformBundle:Page')
        ;

        $limiteCount = 30;
        $listePages = $repository->findBy(
          array('corpus' => $corpusId),
          null,
          $limiteCount+1 
        );

        $nombrePages = count($listePages);
        if( $nombrePages < $limiteCount+1 ){
            return $this->viewAllPagesAction($corpusId);
        }
        else{
            //return $this->selectCatalogueAction($request, $corpusId);
            return $this->selectAction($corpusId);
        }

        return new Response("Positive");
    }

    // Opens browser view for all pages for a corpus having max 30 pages
    public function viewAllPagesAction($corpusId)
    {
        $em = $this->getDoctrine()->getManager();
            
        $repository = $em->getRepository('PHuNPlatformBundle:Page');
        $corpus = $em->getRepository('PHuNPlatformBundle:Corpus')->findOneById($corpusId);
        
        $limiteCount = 30;
        $listPages = $repository->findBy(
          array('corpus' => $corpusId),
          null,
          $limiteCount 
        );
        
        $repository = $this->getDoctrine()->getRepository('PHuNPlatformBundle:Transcription');
        $listLatestTranscriptions = [];
        foreach ($listPages as $page) {
            
            $pageId = $page->getId();
            $listTranscriptions = $repository->findBy(
                array('page' => $pageId),
                array('date' => 'DESC')
            );
            if ($listTranscriptions != null ) {
                $listLatestTranscriptions[] = $listTranscriptions[0];
                //$transcription_date    = $transcription->getDate();
            } else {
                //$listLatestTranscriptions = null;
                $listFilteredPages[] = $page ;
            }
             
        }

        return $this->render(
            'PHuNPlatformBundle:PageBrowser:selectPage.html.twig',
            array(
                'listPages' => $listFilteredPages,
                'listLatestTranscriptions' => $listLatestTranscriptions,
                'corpusId'  => $corpusId,
                'corpus'    => $corpus
        ));
    }
    
    // Redirects to selectPage.html.twig for corpus having >= 30 pages
    public function selectAction($id) {
        
        $em = $this->getDoctrine()->getManager();
        
        $catalogueList = $em->getRepository('PHuNPlatformBundle:Catalogue')
            ->findByCorpus($id);
        $corpus = $em->getRepository('PHuNPlatformBundle:Corpus')
            ->findOneById($id);   
        
        $associatedCatalogue;// = array( "catalogue", array("dossier", array("sousDossier") ) ) ;
        
        
        foreach ($catalogueList as $catalogue)
        {
            $dossierList = $em->getRepository('PHuNPlatformBundle:Dossier')
                                  ->findByCatalogue($catalogue);

            $associatedDossier = array();
            foreach ($dossierList as $dossier)
            {
                $listSousDossier = $em->getRepository('PHuNPlatformBundle:SousDossier')
                                  ->findByDossier($dossier);
                $associatedSousDossier = array();
                foreach ($listSousDossier as $sousDossier) 
                {
                    if($sousDossier->getName() == 'unnamed') {
                        $sousDossier->setName('Pages');
                    }
                    
                    $listPages = $em->getRepository('PHuNPlatformBundle:Page')
                        ->findBySousdossier($sousDossier);
                    $associatedSousDossier[] = array( "sousDossier" => $sousDossier,
                                                      "nombrePages" => count($listPages) );
                    
                }

                $associatedDossier[] = array( "dossier" => $dossier, "associatedSousDossier" => $associatedSousDossier);
            }
            $associatedCatalogue[] = array( "catalogue" => $catalogue, "associatedDossier" => $associatedDossier );
        }
        
        return $this->render(
            'PHuNPlatformBundle:PageBrowser:select.html.twig',
            array(
                'associatedCatalogue'=> $associatedCatalogue,
                'corpusId'           => $id,
                'corpus'             => $corpus
            ));
    }
    
    // Opens browser view for all pages using page selector : from selectAction()
    public function selectPagesAction($sousDossierId)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('PHuNPlatformBundle:Page')
        ;

        $listPages = $repository->findBy(
          array('sousdossier' => $sousDossierId)
        );
        
        $corpus = $listPages[0]->getCorpus();
        $corpusId = $listPages[0]->getCorpus()->getId();
        
        $repository = $this->getDoctrine()->getRepository('PHuNPlatformBundle:Transcription');
        $listLatestTranscriptions = [];
        foreach ($listPages as $page) {
            
            $pageId = $page->getId();
            $listTranscriptions = $repository->findBy(
                array('page' => $pageId),
                array('date' => 'DESC')
            );
            if ($listTranscriptions != null ) {
                $listLatestTranscriptions[] = $listTranscriptions[0];
                //$transcription_date    = $transcription->getDate();
            } else {
                //$listLatestTranscriptions = null;
                $listFilteredPages[] = $page ;
            }
             
        }
        
        return $this->render(
            'PHuNPlatformBundle:PageBrowser:selectPage.html.twig',
            array(
                'listPages' => $listFilteredPages,
                'listLatestTranscriptions' => $listLatestTranscriptions,
                'corpusId'  => $corpusId,
                'corpus'    => $corpus
            ));
    }
    
    
    
    public function selectTranscriptionsAction($sousDossierId)
    {
            $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('PHuNPlatformBundle:Page')
            ;

            $listPages = $repository->findBy(
              array( 'sousdossier' => $sousDossierId) );
            
            $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('PHuNPlatformBundle:Transcription')
            ;
            
            $listTranscriptions = $repository->findAll();
            
            $newListTranscriptions = array();
            for($i = 0 ; $i <count($listPages); $i++) {
                foreach ( $listTranscriptions as $transcription ) {
                    $pageId = $listPages[$i]->getId();
                    $pageIdOfTranscription = $transcription->getPage()->getId();
                    if ($pageId == $pageIdOfTranscription ) {
                        $newListTranscriptions[] = $transcription;
                    }
    //                $listTranscriptions[] = $repository->findBy( array('page' => $page) );
                }
            }
            
            $uniqueListTranscriptions = array();
            if( count($newListTranscriptions) == 0 ) {
                $uniqueListTranscriptions = null;
            }
            else {
                foreach ($newListTranscriptions as $transcription) {

                    $transcription_page_id = $transcription->getPage()->getId();
                    $transcription_date    = $transcription->getDate();

                    $is_in_unique = 0;

                    for ($i = 0; $i < count($uniqueListTranscriptions); $i++)
                    {
                            // unique transcription
                            $unique_transcription = $uniqueListTranscriptions[$i];

                            // unique transcription page id
                            $unique_transcription_page_id = $unique_transcription->getPage()->getId();

                            // Check if current transcription is in unique transcription list
                            if ($unique_transcription_page_id == $transcription_page_id) {
                                    $is_in_unique++;

                                    if ($transcription_date > $unique_transcription->getDate()) {
                                            $uniqueListTranscriptions[$i] = $transcription;
                                    }
                            }
                    }

                    if ($is_in_unique == 0)
                    {
                            $uniqueListTranscriptions[] = $transcription;
                    }
                }
            }
            
            $corpus = $listPages[0]->getCorpus();
            $corpusId = $listPages[0]->getCorpus()->getId();

            return $this->render(
                'PHuNPlatformBundle:PageBrowser:transcriptions_en_cours.html.twig',
                array(
                    'listPages' => $listPages,
                    'listTranscriptions' => $uniqueListTranscriptions,
                    'corpusId'  => $corpusId,
                    'corpus'    => $corpus
                    )
            );
    }




    public function selectFullAction($corpusId, $catalogueId, $dossierId, $sousDossierId)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('PHuNPlatformBundle:Page')
        ;

        $listPages = $repository->findBy(
          array('sousdossier' => $sousDossierId)
        );

        return $this->render(
            'PHuNPlatformBundle:PageBrowser:selectPage.html.twig',
            array(
                'listPages' => $listPages
        ));
    }
    
 
    public function transcriptionBrowserAction($id) {
        
        $em = $this->getDoctrine()->getManager();
        
        $catalogueList = $em->getRepository('PHuNPlatformBundle:Catalogue')
                            ->findByCorpus($id);
        
        $associatedCatalogue;// = array( "catalogue", array("dossier", array("sousDossier") ) ) ;
        
        $corpus = $em->getRepository('PHuNPlatformBundle:Corpus')->findOneById($id);
        foreach ($catalogueList as $catalogue)
        {
            $dossierList = $em->getRepository('PHuNPlatformBundle:Dossier')
                                  ->findByCatalogue($catalogue);

            $associatedDossier = array();
            foreach ($dossierList as $dossier)
            {
                $listSousDossier = $em->getRepository('PHuNPlatformBundle:SousDossier')
                                  ->findByDossier($dossier);
                foreach ($listSousDossier as $sousDossier) 
                {
                    if($sousDossier->getName() == 'unnamed') {
                        $sousDossier->setName('Pages');
                    }
                    // Page counter
                    $listPages = $em->getRepository('PHuNPlatformBundle:Page')
                                        ->findBySousdossier($sousDossier);
                    
                    $associatedSousDossier[] = array( "sousDossier" => $sousDossier,
                                                       "nombrePages" => count($listPages) );
                }

                //$associatedDossier[] = array( "dossier" => $dossier, "associatedSousDossier" => $listSousDossier );
                $associatedDossier[] = array( "dossier" => $dossier, "associatedSousDossier" => $associatedSousDossier);
            }
            $associatedCatalogue[] = array( "catalogue" => $catalogue, "associatedDossier" => $associatedDossier );
        }
        
        return $this->render(
            'PHuNPlatformBundle:PageBrowser:select_transcriptions.html.twig',
            array(
                'associatedCatalogue'=> $associatedCatalogue,
                'corpusId' => $id,
                'corpus'   => $corpus
//                'listCatalogue'     => $catalogueList,
//                'listDossier'       => $listDossier,
//                'listSousDossier'   => $listSousDossier 
                //'listPages' => $listPages
            ));
    }
    
    public function selectProjectAction($id) {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('PHuNPlatformBundle:Corpus')
        ;
            
        $corpus = $repository->findOneById($id);
        
        $listUsers = $this->viewContributors($id);
        
        return $this->render('PHuNPlatformBundle:PageBrowser:description.html.twig',
            array(
                'corpus'    => $corpus,
                'corpusId'  => $id,
                'listUsers' => $listUsers
            ));
        
    }
    
    public function viewContributors($id) {
            
            $user = $this->getUser();
            $repository = $this
		  ->getDoctrine()
		  ->getManager()
		  ->getRepository('PHuNPlatformBundle:Corpus')
            ;
            $corpus = $repository->findById($id);
            
            
            $repository = $this
		  ->getDoctrine()
		  ->getManager()
		  ->getRepository('PHuNPlatformBundle:Page') 
            ;
            $listPages = $repository->findBy(array('corpus' => $corpus));
            
            $repository = $this
		  ->getDoctrine()
		  ->getManager()
		  ->getRepository('PHuNPlatformBundle:Transcription') 
                ;
            $listTranscriptions = $repository->findAll();
            $listUsers = array();

            foreach($listTranscriptions as $transcription) {
                //$listPagesOfTranscriptions[] = $transcription->getPage();
                $page_id = $transcription->getPage()->getId();
                
                for($i=0 ; $i<count($listPages); $i++) {
                if($page_id == $listPages[$i]->getId()) {
                        $listUsers[] = $transcription->getUser();
                    }
                }
            }
            $uniqueListUsers = array();
            if (count($listUsers) == 0) {
                $uniqueListUsers = null;
            } else {
               foreach($listUsers as $user2check) {

                    $is_user_unique = true;
                    foreach ( $uniqueListUsers as $uniqueUser){
                        if( $user2check == $uniqueUser )
                            $is_user_unique = false;
                    }

                    if( $is_user_unique ){
                        $uniqueListUsers[] = $user2check;
                    }
                } 
            }
            
        return $uniqueListUsers;    
    }
    
    public function showProtocolAction($id) {
        
        $repository = $this
		  ->getDoctrine()
		  ->getManager()
		  ->getRepository('PHuNPlatformBundle:Corpus')
        ;
        $corpus = $repository->findOneById($id);
//        $corpusId = $corpus->getId();
        
        return $this->render('PHuNPlatformBundle:Admin:protocol.html.twig', 
            array(
                'corpus' => $corpus
//                'corpusId' => $corpusId
            )
        );
    }

    
    // UNUSED Functions : 
    // Selection of a catalogue
    public function selectCatalogueAction(Request $request, $corpusId)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('PHuNPlatformBundle:Corpus')
        ;

        $corpus = $repository->findOneById($corpusId);

        $catalogue = new Catalogue;
        $catalogue->setCorpus($corpus);
        $em = $this->getDoctrine()->getManager();
        $form = $this->get('form.factory')->create(new CatalogueType($em), $catalogue);

        if ($form->handleRequest($request)->isValid()) {
            $idCatalogue_chosen = $form->getData()->getName()->getId();


            return $this->redirect(
                $this->generateUrl(
                    'page_browser_select_dossier',
                    array(
                        'catalogueId' => $idCatalogue_chosen,
                        'corpus' => $corpus
                    )
                ))
            ;
        }

        return $this->render(
            'PHuNPlatformBundle:PageBrowser:selectCatalogue.html.twig',
            array(
                'form' => $form->createView(),
                'corpus' => $corpus
        ));
    }





    public function selectDossierAction(Request $request, $catalogueId)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('PHuNPlatformBundle:Catalogue')
        ;

        $catalogue = $repository->findOneById($catalogueId);

        // Formuaire pour les catalogues
        $em = $this->getDoctrine()->getManager();
        $formCatalogue = $this->get('form.factory')->create(new CatalogueType($em), $catalogue);

        if ($formCatalogue->handleRequest($request)->isValid()) {
            $idCatalogue_chosen = $formCatalogue->getData()->getName()->getId();


            return $this->redirect(
                $this->generateUrl(
                    'page_browser_select_dossier',
                    array(
                        'catalogueId' => $idCatalogue_chosen
                    )
                ))
            ;
        }

        $catalogue = $repository->findOneById($catalogueId);
        // formulaire pour les dossiers
        $dossier = new Dossier;
        $dossier->setCatalogue($catalogue);

        $formDossier = $this->get('form.factory')->create(new DossierType($em), $dossier);

        if ($formDossier->handleRequest($request)->isValid()) {
            $idDossier_choosed = $formDossier->getData()->getName()->getId();

            return $this->redirect(
                $this->generateUrl(
                    'page_browser_select_sous_dossier',
                    array(
                        'catalogueId' => $catalogueId,
                        'dossierId' => $idDossier_choosed
                    )
                ))
            ;
        }

        return $this->render(
            'PHuNPlatformBundle:PageBrowser:selectDossier.html.twig',
            array(
                'formDossier' => $formDossier->createView(),
                'formCatalogue' => $formCatalogue->createView(),
                
        ));
    }





    public function selectSousDossierAction(Request $request, $catalogueId, $dossierId)
    {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('PHuNPlatformBundle:Catalogue')
        ;

        $catalogue = $repository->findOneById($catalogueId);
        $corpus = $catalogue->getCorpus();

        // Formuaire pour les catalogues
        $em = $this->getDoctrine()->getManager();
        $formCatalogue = $this->get('form.factory')->create(new CatalogueType($em), $catalogue);

        if ($formCatalogue->handleRequest($request)->isValid()) {
            $idCatalogue_chosen = $formCatalogue->getData()->getName()->getId();


            return $this->redirect(
                $this->generateUrl(
                    'page_browser_select_dossier',
                    array(
                        'catalogueId' => $idCatalogue_chosen,
                        'corpus'      => $corpus
                    )
                ))
            ;
        }

        // formulaire pour les dossiers
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('PHuNPlatformBundle:Dossier')
        ;

        $dossier = $repository->findOneById($dossierId);

        $formDossier = $this->get('form.factory')->create(new DossierType($em), $dossier);

        if ($formDossier->handleRequest($request)->isValid()) {
            $idDossier_chosen = $formDossier->getData()->getName()->getId();

            return $this->redirect(
                $this->generateUrl(
                    'page_browser_select_sous_dossier',
                    array(
                        'catalogueId' => $catalogueId,
                        'dossierId' => $idDossier_chosen,
                        'corpus'    => $corpus
                    )
                ))
            ;
        }

        // formulaire pour les dossiers
        $sousDossier = new SousDossier;
        $sousDossier->setDossier($dossier);

        $formSousDossier = $this->get('form.factory')->create(new SousDossierType(), $sousDossier);

        if ($formSousDossier->handleRequest($request)->isValid()) {
            $idSousDossier_chosen = $formSousDossier->getData()->getName()->getId();

            return $this->redirect(
                $this->generateUrl(
                    'page_browser_select_page',
                    array(
                        'sousDossierId' => $idSousDossier_chosen,
                        'corpus'        => $corpus
                    )
                ))
            ;
        }

        return $this->render(
            'PHuNPlatformBundle:PageBrowser:selectSousDossier.html.twig',
            array(
                'formSousDossier' => $formSousDossier->createView(),
                'formDossier' => $formDossier->createView(),
                'formCatalogue' => $formCatalogue->createView(),
                'corpus'
        ));
    }


}