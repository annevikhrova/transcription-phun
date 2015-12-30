<?php

namespace PHuN\PlatformBundle\Controller;

use Stfalcon\Bundle\TinymceBundle\StfalconTinymceBundle;
use PHuN\PlatformBundle\Form\AdvertType;
use PHuN\PlatformBundle\Entity\Advert;
use PHuN\PlatformBundle\Entity\Application;
use PHuN\PlatformBundle\Entity\Image;
use PHuN\PlatformBundle\Entity\Skill;
use PHuN\PlatformBundle\Entity\AdvertSkill;
use PHuN\PlatformBundle\Entity\Transcription;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse; //important use à déclarer pour l'utilisation de RedirectResponse
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class AdvertController extends Controller
{


	// Correspond to defaults: { _controller: PHuNPlatformBundle:Advert:index } in routing.yml
	public function indexAction($page)
	{
		// Notre liste d'annonce en dur
	    $listAdverts = array(
	      array(
	        'title'   => 'Recherche développpeur Symfony2',
	        'id'      => 1,
	        'author'  => 'Alexandre',
	        'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
	        'date'    => new \Datetime()),
	      array(
	        'title'   => 'Mission de webmaster',
	        'id'      => 2,
	        'author'  => 'Hugo',
	        'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
	        'date'    => new \Datetime()),
	      array(
	        'title'   => 'Offre de stage webdesigner',
	        'id'      => 3,
	        'author'  => 'Mathieu',
	        'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
	        'date'    => new \Datetime())
	    );
		

		if ($page < 1){
			throw new NotFoundHttpException('Page "'.$page.'" inexistante.');
		}
		// $liste_membres = array('1' => 'Gérard', '2' => 'Germaine', '3' => 'Patator');
		// $liste_path = array('1' => 'phun_platform_view', '2' => 'phun_platform_add', '3' => 'phun_platform_edit');
		// $liste_var = $this->createAdvertPage();
		
		// $content = $this->render('PHuNPlatformBundle:Advert:email.html.twig', array('membre' => 19 , 'liste_membres' => $liste_membres , 'liste_path' => $liste_path , 'liste_var' => $liste_var ,'var1' => '<em>Anne</em>'));
		// return new Response($content);

		return $this->render('PHuNPlatformBundle:Advert:index.html.twig', array(
  'listAdverts' => $listAdverts
  		));
		
	}


	public function createAdvertPage() {
		$pages = array();
			for ($i = 1; $i <= 100; $i++) {
				$pages[] = $i;
			}
		return $pages;	
	}

	// Correspond to defaults: { _controller: PHuNPlatformBundle:Advert:index } in routing.yml
	// public function contentAction($idx)
	// {
	// 	//$content = "Ttesting purpose";
	// 	//return new Response("Hello Mustard Boy !");
	// 	$content = $this
	// 		->get('templating')
	// 		->render('PHuNPlatformBundle:Advert:index.html.twig', array('advert_id' => $idx)); // NomduBundle:NomDuContrôleur:NomdeLAction
	// 	return new Response($content);
	// }


	// // Correspond to defaults: { _controller: PHuNPlatformBundle:Advert:view } in routing.yml
	// public function viewAction($id)
	// {
	// 	return new Response("Affichage de l'annonce d'id : ".$id);
	// }

	// Correspond to defaults: { _controller: PHuNPlatformBundle:Advert:view } in routing.yml
	// Correspond to tuto sur requêtes du contrôleur : rajout de l'objet $request :
	// public function viewAction($id, Request $request)
	// {
	// 	$tag = $request->query->get('tag');
	// 	return new Response("Affichage de l'annonce d'id : ".$id.", avec le tag : ".$tag.".");
	// }

	//une nouvelle modification de viewAction pour tester la création (version long) d'une requête
	// public function viewAction($id)
	// {
	// 	// On crée la réponse sans lui donner de contenu pour le moment
	// 	$response = new Response();

	// 	//On crée la réponse sans lui donner de contenu pour le moment
	// 	$response->setContent("Ceci est une page d'erreur 404");

	// 	//On définit le code HTTP à " Not Found " (erreur 404)
	// 	$response->setStatusCode(Response::HTTP_NOT_FOUND);

	// 	//On retourne la réponse
	// 	return $response;


	// }

	//la même méthode viewAction avec la création (version courte) de la requête, association avec la page view.html.twig
	// public function viewAction($id)
	// {
	// 	//On utilise le raccourci : il crée un objet Response
	// 	// Et lui donne comme contenu le contenu du template
	// 	return $this->get('templating')->renderResponse('PHuNPlatformBundle:Advert:view.html.twig', 
	// 		array('id' => $id)
	// 	); 


	// }

	//la même méthode viewAction que précédent mais avec la redirection vers une autre page (définie par $url) : 
	// public function viewAction($id)
	// {
	// 	// //original ligne 1 :
	// 	// $url = $this->get('router')->generate('phun_platform_home');
	// 	// //original ligne 2 :
	// 	// return new RedirectResponse($url); 

	// 	//méthode raccourcie :	
	// 	//return $this->redirectToRoute('phun_platform_home');

	// 	//test pour json encode :
	// 	// Créons nous-mêmes la réponse en JSON, grâce à la fonction json_encode()
 //    	$response = new Response(json_encode(array('id' => $id, 'page' => 456, 'titre' => "Un titre quelconque.")));

	//     // Ici, nous définissons le Content-type pour dire au navigateur
	//     // que l'on renvoie du JSON et non du HTML
	//     $response->headers->set('Content-Type', 'application/xml');

	//     return $response;
	
	// }

	//test de viewAction avec récupération de la session et variables de session
	public function viewAction($id)
	{

		$em = $this->getDoctrine()->getManager();
		
		// On récupère l'annonce id
		$advert = $em
			->getRepository('PHuNPlatformBundle:Advert')
			->find($id)
		;	

		 // $repository = $this->getDoctrine()
		 // 	->getManager()
		 // 	->getRepository('PHuNPlatformBundle:Advert')
		 // ;
		
		if (null === $advert){
			throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
		}

		$listApplications = $em
			->getRepository('PHuNPlatformBundle:Application')
			->findBy(array('advert' => $advert))
		;
		
		$listAdvertSkills = $em
			->getRepository('PHuNPlatformBundle:AdvertSkill')
			->findBy(array('advert' => $advert))
		;
		

		$tableauCategory = array('Développement web', 'Intégrateur');
  		$listFilteredAdverts = $em->getRepository('PHuNPlatformBundle:Advert')
  			->getAdvertwithCategories($tableauCategory);
	

		return $this->render('PHuNPlatformBundle:Advert:view.html.twig', array(
			'advert'			=> $advert,
			'listApplications'	=> $listApplications,
			'listAdvertSkills'	=> $listAdvertSkills,
			'listFilteredAdverts'	=> $listFilteredAdverts,
			));		
		 //On récupère l'entité correspondante à l'id $id
		 // $advert = $repository->find($id);		

			

		// récupération de l'annonce correspondante à l'id $idss
		// 

		return $this->render('PHuNPlatformBundle:Advert:view.html.twig', array('advert' => $advert));
	}

	public function addAction(Request $request)
	{
		
		 // On récupère l'EntityManager
    //$em = $this->getDoctrine()->getManager();

    // Création de l'entité Advert
    $advert = new Advert();

    $form = $this->get('form.factory')->create(new AdvertType, $advert);

    //$advert->setDate(new \Datetime());
    // $form = $this->get('form.factory')->createBuilder('form', $advert)
    // 	->add('date',		'date')
    // 	->add('title',		'text')
    // 	->add('content',	'textarea')
    // 	->add('author',		'text')
    // 	->add('published',	'checkbox', array('required' => false))
    // 	->add('save',		'submit')
    // 	->getForm()
    // ;	

    //$form->handleRequest($request);

    if($form->handleRequest($request)->isValid()){
    	$em = $this->getDoctrine()->getManager();
    	$em->persist($advert);
    	$em->flush();

    	$request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

    	return $this->redirect($this->generateUrl('phun_platform_view', array('id' => $advert->getId())));
    }

    // $advert->setTitle('Recherche développeur Symfony2.');
    // $advert->setAuthor('Alexandre');
    // $advert->setContent("Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…");


    // $em->persist($advert);
    // $em->flush();
    // // On récupère toutes les compétences possibles
    // $listSkills = $em->getRepository('PHuNPlatformBundle:Skill')->findAll();


    // // Pour chaque compétence
    // foreach ($listSkills as $skill) {
    //   // On crée une nouvelle « relation entre 1 annonce et 1 compétence »
    //   $advertSkill = new AdvertSkill();

    //   // On la lie à l'annonce, qui est ici toujours la même
    //   $advertSkill->setAdvert($advert);
    //   // On la lie à la compétence, qui change ici dans la boucle foreach
    //   $advertSkill->setSkill($skill);

    //   // Arbitrairement, on dit que chaque compétence est requise au niveau 'Expert'
    //   $advertSkill->setLevel('Expert');

    //   // Et bien sûr, on persiste cette entité de relation, propriétaire des deux autres relations
    //   $em->persist($advertSkill);
    // }

    // // Doctrine ne connait pas encore l'entité $advert. Si vous n'avez pas définit la relation AdvertSkill
    // // avec un cascade persist (ce qui est le cas si vous avez utilisé mon code), alors on doit persister $advert
    // $em->persist($advert);

    // // On déclenche l'enregistrement
    // $em->flush();

		// //Création de l'entité Image
		// $image = new Image();
		// $image->setUrl('../../../../../PHuN/phun/image_catalogue/images/5896-19-366.jpg');
		// $image->setFichier('nomFichier');
		// $image->setAlt('Job de rêve');

		// //On lie l'image à l'annonce
		// $advert->setImage($image);


		// // On récupère l'EntityManager
		// $em = $this->getDoctrine()->getManager();

		// // Etape 1 : On " persiste " l'entité
		// $em->persist($advert);

		// $em->flush();

		// if($request->isMethod('POST')) {
		// 	$request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.');

		// 	return $this->redirect($this->generateUrl('phun_platform_view', array('id' => $advert->getId())));
		// }

		
		// //Si on n'est pas dans le cas POST, alors on affiche le formulaire
		return $this->render('PHuNPlatformBundle:Advert:add.html.twig', array(
			'form' => $form->createView(),
		));

		//return new response("Hello test");
		
	}


	// 
	public function editAction($id, Request $request)
	{
		
		$em = $this->getDoctrine()->getManager();

		// On récupère l'annonce $id
		$advert = $em->getRepository('PHuNPlatformBundle:Advert')->find($id);

		if(null === $advert){
			throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
		}

		// La méthode findAll retourne toutes les catégories de la bd
		$listCategories = $em->getRepository('PHuNPlatformBundle:Category')->findAll();

		// On boucle sur les catégories pour les lier à l'annonce
		foreach($listCategories as $category){
			$advert->addCategory($category);
		}

		$em->flush();

		return $this->render('PHuNPlatformBundle:Advert:edit.html.twig', array('advert'=>$advert));
		//return new Response("test");
	}

	

	public function deleteAction($id) {

		$em = $this->getDoctrine()->getManager();

		// On récupère l'annonce îd
		$advert = $em->getRepository('PHuNPlatformBundle:Advert')->find($id);

		if (null === $advert){
			throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");
		}

		foreach ($advert->getCategories() as $category){
			$advert->removeCategory($category);
		}

		$em->flush();
		return $this->render('PHuNPlatformBundle:Advert:delete.html.twig');
	}

	public function menuAction($limit)
  	{
	    // On fixe en dur une liste ici, bien entendu par la suite
	    // on la récupérera depuis la BDD !
	    $listAdverts = array(
	      array('id' => 2, 'title' => 'Recherche développeur Symfony2'),
	      array('id' => 5, 'title' => 'Mission de webmaster'),
	      array('id' => 9, 'title' => 'Offre de stage webdesigner')
	    );

	    return $this->render('PHuNPlatformBundle:Advert:menu.html.twig', array(
	      // Tout l'intérêt est ici : le contrôleur passe
	      // les variables nécessaires au template !
	      'listAdverts' => $listAdverts
	    ));
  	}

 //  	public function editImageAction($advertId)
	// {
	//   $em = $this->getDoctrine()->getManager();

	//   // On récupère l'annonce
	//   $advert = $em->getRepository('PHuNPlatformBundle:Advert')->find($advertId);

	//   // On modifie l'URL de l'image par exemple
	//   $advert->getImage()->setUrl('test.png');

	//   // On n'a pas besoin de persister l'annonce ni l'image.
	//   // Rappelez-vous, ces entités sont automatiquement persistées car
	//   // on les a récupérées depuis Doctrine lui-même
	  
	//   // On déclenche la modification
	//   $em->flush();

	//   return $this->redirectToRoute('phun_platform_view', array('id' => $advertId));
		
	//   //return $this->render('PHuNPlatformBundle:Advert:view.html.twig',array('advert' => $advert));
	//   //return new Response('OK');

	// }

	public function listAction()
	{
		$listAdverts = $this
		    ->getDoctrine()
		    ->getManager()
		    ->getRepository('PHuNPlatformBundle:Advert')
		    ->getAdvertWithApplications()
		  ;
	  
	  	foreach($listAdverts as $advert)
	  	{
	  		$advert->getApplications();
	  	}	

	}

}

