<?php

namespace PHuN\PlatformBundle\Controller;

use PHuN\PlatformBundle\Entity\Avatar;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse; //important use à déclarer pour l'utilisation de RedirectResponse
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class LoadAvatarController extends Controller
{


	public function loadAction()
  	{
            $userManager = $this->get('fos_user.user_manager');

            //$listUsers = $userManager->findUsers();
            return new Response(var_dump($listUsers));
            
            /*
            for($i = 0; $i < count($listUsers);$i++) {
                $user = $listUsers[$i];
                if($user != null){
                if ($user->getAvatar() == null ) {
                    
                    // On ajout une image de profil par défaut
                    $avatar = new Avatar();
                    $avatar->setUser($user);
                    $avatar->setFilename('profile.png');
                    $avatar->setUrl('corpus/img/profile.png');

                    $em = $this->getDoctrine()->getManager();
                    $em->persist($avatar);
                    $em->flush();
                }
                }
            }    
             */
  	}
        
        

	
}	