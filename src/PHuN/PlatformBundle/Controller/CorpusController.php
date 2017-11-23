<?php

namespace PHuN\PlatformBundle\Controller;


use PHuN\PlatformBundle\Form\CorpusSetPluginsType;
use PHuN\PlatformBundle\Entity\Plugin;
use PHuN\PlatformBundle\Form\CorpusType;
use PHuN\PlatformBundle\Entity\Corpus;
use PHuN\PlatformBundle\Entity\Page;
use Ivory\GoogleMap\Map;
//use Ivory\GoogleMap\Overlays\OverlayManager;
//use Ivory\GoogleMap\Overlays\Animation;
use Ivory\GoogleMap\Overlays\Marker;
use Ivory\GoogleMap\Overlays\InfoWindow;
use Ivory\GoogleMap\Overlays\InfoWindowType;
//use Ivory\GoogleMap\Base\Coordinate;
//use Ivory\GoogleMap\Control\ControlPosition;
//use Ivory\GoogleMap\Overlays\Icon;
//use Ivory\GoogleMap\Overlays\MarkerShape;
//use Ivory\GoogleMap\Overlays\MarkerShapeType;
//use Ivory\GoogleMapBundle\Entity\MarkerShape;
//use Ivory\GoogleMapBundle\Tests\Fixtures\Model\Overlays\MarkerShape;
//use Ivory\GoogleMap\Entity\Map;
//use Ivory\GoogleMap\Tests\Fixtures\Model\Map;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\DependencyInjection\SimpleXMLElement;



class CorpusController extends Controller
{ 

    /**
     * Displays form allowing to add a new project to database
     * @param Request $request
     * @return type
     * @throws AccessDeniedException
     */
    public function AddCorpusAction(Request $request)
    {
        // Verification of user's admin status 
        if (!$this->get('security.context')->isGranted('ROLE_ADMIN')) {
            // Exception « Accès interdit »
            throw new AccessDeniedException('Accès limité aux administrateurs d\'un projet.');
        }

        $repository = $this->getDoctrine()->getManager()->getRepository('PHuNPlatformBundle:Corpus');

        //$corpus = $repository->findOneById(5);  // Utilisé en cas de tests au lieu de new Corpus();
        $corpus = new Corpus();
        $form = $this->get('form.factory')->create(new CorpusType(), $corpus);
        $corpus->setPluginList('');
        $user = $this->getUser();

        if ($form->handleRequest($request)->isValid()) {

            $corpus->getImage()->upload();
            $corpus->getStylesheet()->upload();
            $corpus->getDtd()->upload();
            $corpus->addUser($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($corpus);
            $em->flush();
            $corpusId = $corpus->getId();

            $dtdFile = $corpus->getDtd()->getUrl();
            $this->forward('phun.dtd_controller:parseDtdFileAction', array('dtdFile' => $dtdFile, 'idCorpus' => $corpusId));

            //CSS parse action
            $cssFile = $corpus->getStylesheet()->getUrl();
            $this->forward( 'phun.css_controller:parseCssFileAction', 
                array('cssFile' => $cssFile, 'idCorpus' => $corpusId )
            );

            $phun_structure = 'corpus/'.$corpus->getName().'_'.$corpus->getId();

            if (!file_exists($phun_structure)) {
                mkdir($phun_structure, 0777, true);
                mkdir($phun_xml = $phun_structure.'/_xml/', 0777, true);
                mkdir($phun_images = $phun_structure.'/images/', 0777, true);
                mkdir($phun_transcriptions = $phun_structure.'/transcriptions/', 0777, true);
                mkdir($phun_thumbs = $phun_structure.'/thumbs/', 0777, true);
            }


            $request->getSession()->getFlashBag()->add('notice', 'Le projet a bien été créé.');

            return $this->redirect($this->generateUrl('phun_platform_add_plugin', ['id' => $corpusId ]));

        }

        return $this->render('PHuNPlatformBundle:Corpus:add_corpus.html.twig', array(
          'form' => $form->createView()
        ));

    }
    
    /**
     * Displays custom corpus header
     * @param integer $id
     * @param Request $request
     * @return twig corpus_header
     */
    public function HeaderAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $corpus = $em->getRepository('PHuNPlatformBundle:Corpus')->findOneById($id);
        $routeName = $request->get('_route');

        return $this->render('PHuNPlatformBundle:Corpus:corpus_header.html.twig', [ 'corpus' => $corpus, 'routeName' => $routeName ]);
    }
    
    /**
     * Displays corpus navtabs
     * @param integer $id
     * @return twig corpus_navtabs
     */
     public function NavTabsAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $corpus = $em->getRepository('PHuNPlatformBundle:Corpus')->findOneById($id);
        $corpusId = $corpus->getId();

        return $this->render('PHuNPlatformBundle:Corpus:corpus_navtabs.html.twig', [ 'corpus' => $corpus, 'corpusId' => $corpusId ]);
        
    }
    
    /**
     * Displays custom corpus footer with associated institutional logos
     * @param integer $id
     * @return twig corpus_footer
     */
    public function FooterAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $corpus = $em->getRepository('PHuNPlatformBundle:Corpus')->findOneById($id);
        $repository = $em->getRepository('PHuNPlatformBundle:Logo');
        $listLogos = $repository->findBy(array('corpus' => $corpus));

        return $this->render('PHuNPlatformBundle:Corpus:corpus_footer.html.twig', [ 'corpus' => $corpus, 'listLogos' => $listLogos ]);
        
    }
    
    /**
     * Displays corpus description
     * @param integer $id
     * @return twig description
     */
    public function viewDescriptionAction($id) {
        $repository = $this->getDoctrine()->getManager()->getRepository('PHuNPlatformBundle:Corpus');        
        $corpus = $repository->findOneById($id);
        $listUsers = $this->getContributors($id);
        
        return $this->render('PHuNPlatformBundle:Corpus:description.html.twig',
            array(
                'corpus'    => $corpus,
                'corpusId'  => $id,
                'listUsers' => $listUsers
            ));
        
    }
    
    /**
     * Displays corpus contributors. This function needs to be completed using Location entity.
     * Further work required.
     * @param integer $id
     * @return twig contributors
     */
    public function viewContributorsAction($id) {
        
        // Create display map for contributors
        $map = new Map();
        $map->setAutoZoom(false);
        $map->setCenter(41.850033,-120.6500523, true);
        $map->setMapOption('zoom', 2);
        $map->setBound(-2.1, -3.9, 2.6, 1.4, true, true);
        $map->setLanguage('fr');
        
           
        $map->setStylesheetOption('width', '100%');
        $map->setStylesheetOption('height', '100%');
        
        
        $repository = $this->getDoctrine()->getManager()->getRepository('PHuNPlatformBundle:Corpus');
            
        $corpus = $repository->findOneById($id);
        
        $listUsers = $this->getContributors($id);
        $arrayUserContributions = [];
        foreach ($listUsers as $user) {
            $repository = $this->getDoctrine()->getManager()->getRepository('PHuNPlatformBundle:Transcription');
            
            $listTranscriptionsByUser = $repository->findByUser($user);        
            $nbTranscriptionsByUser = count($listTranscriptionsByUser);
            $username = $user->getUserName();
            $avatar   = $user->getAvatar();
            $lastLogin = $user->getLastLogin();
            
            $locationId = $user->getLocation();
            
            //get location coordinates for user
            $repository = $this->getDoctrine()
                ->getManager()
                ->getRepository('PHuNPlatformBundle:Location')
            ;
            $location = $repository->findOneById($locationId);
            $locationName = $location->getName();
            $listPositions[] = array('username' => $username, 'latitude' => $location->getLatitude(),
                'longitude' => $location->getLongitude(), 'locationName' => $locationName, 'nbOccurrences' => 0);
            $locationLat = $location->getLatitude();
            $locationLong = $location->getLongitude();
            
            $arrayUserContributions[] = array(
                'username' => $username , 
                'nbContributions' => $nbTranscriptionsByUser, 
                'avatar' => $avatar,
                'lastLogin' => $lastLogin,
                'locationName' => $locationName,
                'locationLat' =>  $locationLat,
                'locationLong' => $locationLong
            );
        }
        
        
        $listCountries = array();
        foreach ( $listPositions as $position ) {
            $is_detected = false;
            foreach ( $listCountries as &$country ) {
                if ( $country["locationName"] == $position['locationName'] ) {
                    $is_detected = true;
                    $country["nbOccurrences"]++;
                    break;
                }
            }
            // A new wonderful and unknown country has been detected
            if (!$is_detected) {
                $listCountries[] = array(
                                        "latitude" => $position['latitude'],
                                        "longitude" => $position['longitude'],
                                        "locationName" => $position['locationName'],
                                        "nbOccurrences" => 1);
            }
        }
        foreach ( $listCountries as $country ) {
            $marker = new Marker();
            $marker->setPosition($country['latitude'], $country['longitude'], true);
            
            

            $infoWindow = new InfoWindow('<h5>'.$country['nbOccurrences'].' pers.</h5>');//, InfoWindowType::INFO_BOX, $marker->getPosition());
            $marker->setInfoWindow($infoWindow);

            $map->addMarker($marker);
        }
        
      
        
        $repository = $this->getDoctrine()->getManager()->getRepository('PHuNPlatformBundle:Avatar');
        
        
        
//        $mapBuilder = $this->get('ivory_google_map.map.builder');
//
//        $mapBuilder->setCenter(55.117100, 23.940332);
//        $mapBuilder->setMapOptions(array(
//                    'mapTypeId' => 'satellite',
//                    'zoom' => 2
//        ));
//        $mapBuilder->setStylesheetOptions(array(
//                    'width' => '100%',
//                    'height' => '100%'
//         ));
//
//        $map = $mapBuilder->build();
        
         
          
         // $fileLocations = 'countries.csv';
          
          


          //fin lecture csv
//***          $marker = new Marker();
//        
//        $marker->setPosition(new Coordinate(1, 1));
//        $marker->setAnimation(Animation::DROP);
//        $marker->setOption('flat', true);
//        $map->getOverlayManager()->addMarker($marker);
//        $marker = new Marker();
//
//        // Configure your marker options
//        $marker->setPrefixJavascriptVariable('marker_');
//***          $marker->setPosition(-34.919,-57.954, true);
//***          $map->addMarker($marker);
//        $marker->setAnimation(Animation::BOUNCE);
//
//        $marker->setOption('clickable', false);
//        $marker->setOption('flat', true);
//        $marker->setOptions(array(
//            'clickable' => true,
//            'flat'      => true,
//        ));
//
//        $map->addMarker($marker);
        //$map = $this->get ( 'ivory_google_map.map' );
        
        return $this->render('PHuNPlatformBundle:Corpus:contributors.html.twig',
            array(
                'corpus'    => $corpus,
                'corpusId'  => $id,
                'listUsers' => $arrayUserContributions,
                'map'       => $map,
                'listPositions' => $listPositions,
                'listCountries' => $listCountries          
            ));
    }
    
    /**
     * Filters contributor list to retain unique entries. Used by viewContributorsAction
     * @param integer $id
     * @return array of unique contributors $uniqueListUsers
     */
    public function getContributors($id) {
            
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
        
}
	

