<?php

namespace PHuN\PlatformBundle\Controller;

use PHuN\PlatformBundle\Entity\Contact;
use PHuN\PlatformBundle\Form\ContactType;
use PHuN\PlatformBundle\Form\PluginType;
use PHuN\PlatformBundle\Form\CorpusType;
use PHuN\PlatformBundle\Entity\Corpus;
use PHuN\PlatformBundle\Entity\Plugin;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse; //important use for RedirectResponse
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class ContactController extends Controller
{
	 /**
     * Send first email to admins
     * @param Request $request
     */ 
	public function askAdminRoleAction(Request $request)
	{
		$corpus = new Contact();
		$form = $this->get('form.factory')->create(new ContactType());

		$request = $this->get('request');

		if($request->getMethod() == 'POST')
		{	
			$form->bind($request);

			$data = $form->getData();

			if($data->getDemande() == true){
				$demande = "[Demande de création de projet]";
			}

			$message = \Swift_Message::newInstance()
			                    ->setContentType('text/html')
			                    ->setSubject($data->getSujet())
			                    ->setFrom($data->getEmail())
			                    ->setTo('phun.adm.contact@gmail.com')
			                    ->setBody($data->getContenu());


			$this->get('mailer')->send($message);

			$request->getSession()->getFlashBag()->add('notice', 'Merci de nous avoir contacté, nous traiterons votre demande dans les plus brefs délais.');

		}

		return $this->render('PHuNPlatformBundle:Contact:contact.html.twig', array('form' => $form->createView())
  		);

	}
	
}