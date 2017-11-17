<?php

namespace PHuN\PlatformBundle\Controller;

use PHuN\PlatformBundle\Form\LogoType;
use PHuN\PlatformBundle\Entity\Logo;
use PHuN\PlatformBundle\Form\AvatarType;
use PHuN\PlatformBundle\Entity\Avatar;
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
use PHuN\PlatformBundle\Entity\Corpus;
use PHuN\PlatformBundle\Entity\Transcription;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse; //important use à déclarer pour l'utilisation de RedirectResponse
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class UserController extends Controller
{
	public function showAction()
	{
		$user = $this->getUser();

		$repository = $this
		  ->getDoctrine()
		  ->getManager()
		  ->getRepository('PHuNPlatformBundle:Avatar')
		;

		$avatar = $repository->findOneByUser($user); 

		return $this->render('PHuNPlatformBundle:Profile:show_content.html.twig', array(
		 	'user' => $user,
		 	'avatar' => $avatar
   		));

	}
        
        public function adminShowAction()
	{
		$user = $this->getUser();

		$repository = $this
		  ->getDoctrine()
		  ->getManager()
		  ->getRepository('PHuNPlatformBundle:Avatar')
		;

		$avatar = $repository->findOneByUser($user); 

		return $this->render('PHuNPlatformBundle:Admin:show_content.html.twig', array(
		 	'user' => $user,
		 	'avatar' => $avatar
   		));

	}
        
        public function adminDashboardAction()
	{
            $user = $this->getUser();

            $repository = $this
              ->getDoctrine()
              ->getManager()
              ->getRepository('PHuNPlatformBundle:Avatar')
            ;

            $avatar = $repository->findOneByUser($user); 
            
            $listCorpus = $user->getCorpora();
	    return $this->render('PHuNPlatformBundle:Admin:admin_dashboard.html.twig', array(
                'user' => $user,
		'avatar' => $avatar,
                'listCorpus' =>$listCorpus
	    ));
	}
        
        public function adminMenuAction()
	{
            $user = $this->getUser();
            $repository = $this
		  ->getDoctrine()
		  ->getManager()
		  ->getRepository('PHuNPlatformBundle:Corpus')
		;
            
            $listCorpus = $user->getCorpora();
            
	    return $this->render('PHuNPlatformBundle:Admin:admin_menu.html.twig', 
                array( //'corpus' => $corpus,
                        'user'  => $user,
                        'listCorpus' => $listCorpus
                    ));
	}
        
        public function adminViewCSSAction($id, Request $request) // $id : corpus id
	{
            //$user = $this->getUser();
            $repository = $this
              ->getDoctrine()
              ->getManager()
              ->getRepository('PHuNPlatformBundle:Corpus')
            ;
            
            $corpus = $repository->findOneById($id);
            $stylesheetId = $corpus->getStylesheet()->getId();
            
            $repository = $this
              ->getDoctrine()
              ->getManager()
              ->getRepository('PHuNPlatformBundle:Stylesheet') /** Code améliorations à venir **/
            ;
            
            $stylesheet = $repository->findOneById($stylesheetId); 
            $urlCSS     = $stylesheet->getUrl();
            $contents = file_get_contents($urlCSS);
            
            $data = array('contents' => $contents);
            //$data[] = $contents;
            
            $form = $this->createFormBuilder($data)
                ->add('contents', 'textarea')
                ->add('save',       'submit', ['label' => 'Sauvegarder'])
            ->getForm();
            
            if ($request->isMethod('POST')) {
                $form->handleRequest($request);
                
                if ($form->isValid()) {
                    // data is an array with "name", "email", and "message" keys
                    $data = $form->getData();
                    
                    file_put_contents($urlCSS, $data['contents']);
                    //return new Response (var_dump($data['contents']) );
                    return $this->render('PHuNPlatformBundle:Admin:saved.html.twig', array('corpus' => $corpus ));
                }
            }
            
	    return $this->render('PHuNPlatformBundle:Admin:admin_view_css.html.twig', array(
                'urlCSS' => $urlCSS,
                'contents' => $contents,
                'form' => $form->createView()
	    ));
	}
        public function adminEditDescriptionAction($id, Request $request) {
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('PHuNPlatformBundle:Corpus');
            
            $corpus = $repository->findOneById($id);
            $description = $corpus->getDescription();
            
            $data = array('description' => $description);
            
            $form = $this->createFormBuilder($data)
                ->add('description', 'textarea')
                ->add('save',       'submit', ['label' => 'Sauvegarder'])
            ->getForm();
            
            if ($request->isMethod('POST')) {
                $form->handleRequest($request);
                
                if ($form->isValid()) {
                    // data is an array with "name", "email", and "message" keys
                    $data = $form->getData();
                    $corpus->setDescription($data['description']);
                    
                    $em->persist($corpus);
                    $em->flush();
                    //file_put_contents($, $data['description']);
                    //return new Response (var_dump($data['contents']) );
                    return $this->render('PHuNPlatformBundle:Admin:saved.html.twig', array('corpus' => $corpus ));
                }
            }
            
	    return $this->render('PHuNPlatformBundle:Admin:admin_edit_description.html.twig', array(
                'description' => $description,
                'corpus'      => $corpus,
                'form' => $form->createView()
	    ));
            
        }
        public function adminAddLogosAction($id, Request $request) {
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('PHuNPlatformBundle:Corpus');
            
            $corpus = $repository->findOneById($id);
            
            $folder_name    = 'corpus/logos/';
            $repository = $em->getRepository('PHuNPlatformBundle:Logo');
            $listLogos = $repository->findBy(array('corpus' => $corpus));
            
            $logo = new Logo();
            $form = $this->get('form.factory')->create(new LogoType(), $logo);
            
            // Create folder for new file if it doesn't already exist 
            if (!file_exists($folder_name)) {
                mkdir($folder_name, 0755, true);
            }
            
            if ($request->isMethod('POST')) {
                $form->handleRequest($request);
                
                if ($form->isValid()) {
                    
                    $logo->upload();
                    $logo->setCorpus($corpus);

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($logo);
                    $em->flush();
                    
                    
                    return $this->render('PHuNPlatformBundle:Admin:saved.html.twig', array('corpus' => $corpus ));
                }
            }
            
            return $this->render('PHuNPlatformBundle:Admin:admin_logos.html.twig', array(
                'listLogos' => $listLogos,
                'corpus'    => $corpus,
                'form' => $form->createView()
	    ));
        }
        
//        public function adminSaveCSSAction(Request $request)
//	{
//            if (!$request->isMethod(Request::METHOD_POST)) {
//                return;
//            }
//            
//            if ($request->isMethod('POST')) {
//                $form->handleRequest($request);
//                
//                if ($form->isValid()) {
//                    // data is an array with "name", "email", and "message" keys
//                    $data = $form->getData();
//                    
//                    echo $data;
//                }
//            }
//            
//	    return $this->render('PHuNPlatformBundle:Admin:admin_view_css.html.twig', array(
//                'urlCSS' => $urlCSS,
//                'contents' => $contents
//	    ));
//	}
        
//        public function adminViewContributorsAction($id) {
//            
//            $user = $this->getUser();
//            $repository = $this
//		  ->getDoctrine()
//		  ->getManager()
//		  ->getRepository('PHuNPlatformBundle:Corpus')
//            ;
//            $corpus = $repository->findById($id);
//            
//            
//            $repository = $this
//		  ->getDoctrine()
//		  ->getManager()
//		  ->getRepository('PHuNPlatformBundle:Page') 
//            ;
//            $listPages = $repository->findBy(array('corpus' => $corpus));
//            $listUsers = [];
//            $repository = $this
//		  ->getDoctrine()
//		  ->getManager()
//		  ->getRepository('PHuNPlatformBundle:Transcription') 
//                ;
//            $listTranscriptions = $repository->findAll();
//            foreach($listTranscriptions as $transcription) {
//                //$listPagesOfTranscriptions[] = $transcription->getPage();
//                $page_id = $transcription->getPage()->getId();
//                
//                for($i=0 ; $i<count($listPages); $i++) {
//                if($page_id == $listPages[$i]->getId()) {
//                        $listUsers[] = $transcription->getUser();
//                    }
//                }
//            }
//            return $this->render('PHuNPlatformBundle:Admin:contributors.html.twig', 
//                array( 'corpus' => $corpus,
//                       'listUsers'      => $listUsers
//                       // 'listPages' => $pages_by_corpus
//                    )
//            );
//        }
        
    public function adminViewContributorsAction($id, Request $request) {
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('PHuNPlatformBundle:Corpus')
        ;
            
        $corpus = $repository->findOneById($id);
        
        $listUsers = $this->getContributors($id);
        $arrayUserContributions = [];
        if($listUsers != null) {
            foreach ($listUsers as $user) {
                $repository = $this->getDoctrine()
                    ->getManager()
                    ->getRepository('PHuNPlatformBundle:Transcription');

                $listTranscriptionsByUser = $repository->findByUser($user);        
                $nbTranscriptionsByUser = count($listTranscriptionsByUser);
                $userId = $user->getId();
                $username = $user->getUserName();
                $userEmail = $user->getEmail();
                $avatar   = $user->getAvatar();
                $lastLogin = $user->getLastLogin();
                $roles      = $user->getRoles();
                $locked     = $user->getLocked();
                $arrayUserContributions[] = array(
                        'id'    => $userId,
                        'username' => $username,
                        'email' => $userEmail,
                        'nbContributions' => $nbTranscriptionsByUser, 
                        'avatar' => $avatar,
                        'lastLogin' => $lastLogin,
                        'roles'      => $roles,
                        'locked'     => $locked
                );
            }
        }
        
        $repository = $this->getDoctrine()
            ->getManager()
            ->getRepository('PHuNPlatformBundle:Avatar')
        ;
        
//        $form = $this->createFormBuilder()
//            ->add('selection', 'checkbox', array('compound' => true))
//            ->add('delete',       'submit', ['label' => 'Supprimer'])
//            ->add('downgrade',       'submit', ['label' => 'Retrograder'])
//            ->add('suspend',       'submit', ['label' => 'Suspendre'])
//            ->add('promote',       'submit', ['label' => 'Promoter'])    
//        ->getForm();
        
        
        return $this->render('PHuNPlatformBundle:Admin:contributors.html.twig',
            array(
                'corpus'    => $corpus,
                'corpusId'  => $id,
                'listUsers' => $arrayUserContributions,
//                'form'      => $form->createView()
//                'listAvatars' => $listAvatars
            ));
    }
    
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
    
//    public function deleteUserAction($id, $listUsers) {
//        
//        $listUsers = explode(",", $listUsers);
//        $em = $this->getDoctrine()->getManager();
//        //return new Response(var_dump($listUsers));
//        foreach($listUsers as $userId) {
//            $user = $em->getRepository('PHuNUserBundle:User')->findOneById($userId);
//            $em->remove($user);
//        }
//        //return new Response(var_dump($listUsers));
//        $em->flush();
//        //return $this->adminViewContributorsAction(array($id));
//        return $this->redirectToRoute('admin_view_contributors', array('id' => $id));    
//    }
    
    public function demoteUserAction($id, $listUsers) {
        $listUsers = explode(",", $listUsers);
        $em = $this->getDoctrine()->getManager();
        $corpus = $em->getRepository('PHuNPlatformBundle:Corpus')->findOneById($id);
        
        $request = $this->getRequest();
        //return new Response(var_dump($listUsers));
        foreach($listUsers as $userId) {
            $user = $em->getRepository('PHuNUserBundle:User')->findOneById($userId);
            if($user->hasRole("ROLE_SUPER_ADMIN")) {
                $request->getSession()
                ->getFlashBag()
                ->add('warning', 'Vous ne pouvez pas effectuer cette opération sur un administrateur !')
            ;

            }else if($user->hasRole("ROLE_ADMIN")) {
                $user->setRoles(array("ROLE_AUTEUR"));
                $user->removeCorpora($corpus);
                $em->persist($user);
                
            }
            
        }
        $em->flush();
        //return $this->adminViewContributorsAction(array($id));
        return $this->redirectToRoute('admin_view_contributors', array('id' => $id));
    }
    
    public function suspendUserAction($id, $listUsers) {
        $listUsers = explode(",", $listUsers);
        $em = $this->getDoctrine()->getManager();
        
        $request = $this->getRequest();
        //return new Response(var_dump($listUsers));
        foreach($listUsers as $userId) {
            $user = $em->getRepository('PHuNUserBundle:User')->findOneById($userId);
            if($user->hasRole("ROLE_ADMIN") || $user->hasRole("ROLE_SUPER_ADMIN")) {
                $request->getSession()
                ->getFlashBag()
                ->add('warning', 'Vous ne pouvez pas effectuer cette opération sur un administrateur !')
            ;

            }else if($user->hasRole("ROLE_AUTEUR") || $user->hasRole("ROLE_RELECTEUR")) {
                $locked = $user->isLocked();
                if($locked == false) {
                    $user->setLocked(!$locked);
                    $em->persist($user);
                }
            }
            // if user is super_admin he can suspend other simple admin users
            // ...
        }
        //return new Response(var_dump($listUsers));
        $em->flush();
        //return $this->adminViewContributorsAction(array($id));
        return $this->redirectToRoute('admin_view_contributors', array('id' => $id));
    }
    
    public function promoteUserAction($id, $listUsers) {
        $listUsers = explode(",", $listUsers);
        $em = $this->getDoctrine()->getManager();
        $corpus = $em->getRepository('PHuNPlatformBundle:Corpus')->findOneById($id);
        
        $request = $this->getRequest();
        //return new Response(var_dump($listUsers));
        foreach($listUsers as $userId) {
            $user = $em->getRepository('PHuNUserBundle:User')->findOneById($userId);
            if($user->hasRole("ROLE_ADMIN") || $user->hasRole("ROLE_SUPER_ADMIN")) {
                $request->getSession()
                ->getFlashBag()
                ->add('warning', 'Vous ne pouvez pas effectuer cette opération sur un administrateur !')
            ;

            }else if($user->hasRole("ROLE_AUTEUR") || $user->hasRole("ROLE_RELECTEUR")) {
                $user->setRoles(array("ROLE_ADMIN"));
                $user->addCorpora($corpus);
                $em->persist($user);
                
            }
            
        }
        $em->flush();
        //return $this->adminViewContributorsAction(array($id));
        return $this->redirectToRoute('admin_view_contributors', array('id' => $id));
        
    }
    
    public function reactivateUserAction($id, $userId) {
        
        $em = $this->getDoctrine()
            ->getManager();
            
        $user = $em->getRepository('PHuNUserBundle:User')->findOneById($userId);
        
        $nonLocked = $user->isAccountNonLocked();
        $user->setLocked($nonLocked);
        $em->persist($user);
        $em->flush();
        //return $this->forward(adminViewContributorsAction(array($id)));
        return $this->redirectToRoute('admin_view_contributors', array('id' => $id)); 
        //return $this->adminViewContributorsAction(array($id, $this->getRequest()));
    }
        
    public function adminViewTranscriptionsAction($id) {
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
            foreach($listTranscriptions as $transcription) {
                //$listPagesOfTranscriptions[] = $transcription->getPage();
                $page_id = $transcription->getPage()->getId();
                
                for($i=0 ; $i<count($listPages); $i++) {
                if($page_id == $listPages[$i]->getId()) {
                        $listTranscriptionsduProjet[] = $transcription;
                    }
                }
            }
            return $this->render('PHuNPlatformBundle:Admin:transcriptions.html.twig', 
                array( 'corpus' => $corpus,
                       'listTranscriptions'      => $listTranscriptionsduProjet
                       // 'listPages' => $pages_by_corpus
                    )
            );
        }
	
        // Fonctions qui concerne l'utilisateur simple et non pas des utilisateurs admin
	public function changeAvatarAction($id, Request $request)
	{
		$repository = $this
		  ->getDoctrine()
		  ->getManager()
		  ->getRepository('PHuNPlatformBundle:Avatar')
		;

		$avatar = $repository->findOneByUser($id);  

		// Form creation for the transcription
                $form = $this->get('form.factory')->create(new AvatarType(), $avatar);
		
		if ( $form->handleRequest($request)->isValid() )
                {
                    $avatar->upload();
                    
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($avatar);
                    $em->flush();

                    return $this->redirect($this->generateUrl('user_profile_show'));
		}

		return $this->render('PHuNPlatformBundle:Profile:change_avatar.html.twig', array(
		 	'form' => $form->createView()
   		));
		
	}

	public function showTranscriptionsAction()
	{
		$user = $this->getUser();

		$repository = $this
		  ->getDoctrine()
		  ->getManager()
		  ->getRepository('PHuNPlatformBundle:Avatar')
		;

		$avatar = $repository->findOneByUser($user); 

   		$repository = $this
		  ->getDoctrine()
		  ->getManager()
		  ->getRepository('PHuNPlatformBundle:Transcription')
		;
                
                // Search transcription table by user
		$listTranscriptions = $repository->findByUser($user);
		
		$uniqueListTranscriptions = array();

		foreach ($listTranscriptions as $transcription) {

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
                                        // if multiple transcription exist for this page, add only the most recently dated transcription
					if ($transcription_date > $unique_transcription->getDate()) {
                                            $uniqueListTranscriptions[$i] = $transcription;
                                             
					}
                                        
                                         
				}
			}
                        
                        // if no other transcriptions exist for this page, add this transcription
			if ($is_in_unique == 0)
			{
				$uniqueListTranscriptions[] = $transcription;
			}
                        
		}
                
                // Find the very last transcription linked to page transcription
                for( $i = 0; $i < count($uniqueListTranscriptions); $i++ )
                {
                    $userTranscription_page_id	= $uniqueListTranscriptions[$i]->getPage()->getId();
                    //$userTranscription_date     = $uniqueListTranscriptions[$i]->getDate();

                    // Find transcription with same Page Id
                            $corresponding_transcriptions = $repository->findByPage($userTranscription_page_id);

                    // Find the last transcription made for this page
                    foreach( $corresponding_transcriptions as $t_to_test){
                        if ( $uniqueListTranscriptions[$i]->getDate() < $t_to_test->getDate()) {  //if $t_to_test is greater than $i, we keep $t_to_test
                            $uniqueListTranscriptions[$i] = $t_to_test;
                        }
                    }    
                }  
                /* end of main filter */
		$array_all_dates = array();

		foreach ($listTranscriptions as $unique_tcp)
		{
			$id_page = $unique_tcp->getPage()->getId();

			$list_date_tcp = array();
			$list_date_nb_revision = array();

			// $list_date_tcp[] = $unique_tcp->getDate();
			// $list_date_nb_revision[] = 1;

			for ($i = 0; $i < count($listTranscriptions); $i++)
			{
				$tcp = $listTranscriptions[$i];
				$id_page_current = $tcp->getPage()->getId();

				if( $id_page == $id_page_current )
				{
					$current_date = $tcp->getDate();
					$current_date = new \DateTime( $current_date->format("Y-m-d") );

					$is_date_in_list = 0;

					for ($j = 0; $j < count($list_date_tcp); $j++)
					{
						$alreadyDetected_date = $list_date_tcp[$j];
						$alreadyDetected_date = new \DateTime( $alreadyDetected_date->format("Y-m-d") );

						// echo "<div>".var_dump($current_date)."</div>";
						// echo "<div>".var_dump($alreadyDetected_date)."</div>";

						if( $current_date == $alreadyDetected_date )
						{
						// echo "<div> IT HAS DETECTED</div>";
							$list_date_nb_revision[$j]++;
							$is_date_in_list++;

							array_splice( $listTranscriptions, $i, 1);
							$i--;

							break;
						}
						// echo "<div> </div>";
					}

					if( $is_date_in_list == 0 )
					{
						$list_date_tcp[] = $current_date;
						$list_date_nb_revision[] = 1;

						array_splice( $listTranscriptions, $i, 1);
						$i--;
					}

				}	
			}



			$tcp_graph = array();
			for ($p = 0; $p < count($list_date_tcp); $p++){
				$newSerie = array( "date" => $list_date_tcp[$p], "nb" => $list_date_nb_revision[$p] );
				$tcp_graph[] = $newSerie;
			}

			asort($tcp_graph);

			if( count($tcp_graph) > 0 )
				$array_all_dates[] = array("name" => $unique_tcp->getPage()->getAlt(), "graph" => $tcp_graph);
		} 

		

		// $listTranscriptions = $repository->findByUser($user);

			// return new Response(var_dump($array_all_dates));


		return $this->render('PHuNPlatformBundle:Profile:show_transcriptions.html.twig', array(
		 	'user' => $user,
		 	'avatar' => $avatar,
		 	'listTranscriptions' => $listTranscriptions,
		 	'uniqueListTranscriptions' => $uniqueListTranscriptions,
		 	'seriesDate' => $array_all_dates
   		));
	}


}