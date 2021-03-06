<?php
// src/PHuN/UserBundle/Controller/SecurityController.php;

namespace PHuN\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class SecurityController extends Controller
{
  public function loginAction(Request $request)
  {
//     // Si le visiteur est déjà identifié, on le redirige vers l'accueil
    if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
      $redirectUrl = $request->getSession()->get('_security.account.target_path');
      //return $this->redirectToRoute('fos_user_profile_show');
    $referer = $request->headers->get('referer');
      return $this->redirect($referer);
    }
    
//     // Le service authentication_utils permet de récupérer le nom d'utilisateur
//     // et l'erreur dans le cas où le formulaire a déjà été soumis mais était invalide
//     // (mauvais mot de passe par exemple)
    $authenticationUtils = $this->get('security.authentication_utils');

    return $this->render('PHuNUserBundle:Security:login.html.twig', array(
      'last_username' => $authenticationUtils->getLastUsername(),
      'error'         => $authenticationUtils->getLastAuthenticationError(),
    ));
  }
}