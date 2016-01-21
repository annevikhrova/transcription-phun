<?php

namespace PHuN\PlatformBundle\Controller;

use PHuN\PlatformBundle\Form\PluginType;
use PHuN\PlatformBundle\Form\CorpusType;
use PHuN\PlatformBundle\Form\ElementType;
use PHuN\PlatformBundle\Entity\Corpus;
use PHuN\PlatformBundle\Entity\Plugin;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse; //important use à déclarer pour l'utilisation de RedirectResponse
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class PluginController extends Controller
{

	public function generationXSLAction()
	{
		$this->createXSLTemplate_Html2XmlAction();
		$this->createXSLTemplate_Xml2HtmlAction();
		return new Response ("Réussie !");
	}

	public function createXSLTemplate_Html2XmlAction()
	{
		$fileName_result = "xsl/xsl_gen/html2xml.xsl";

		// Repository de la table page
		 $repository = $this->getDoctrine()
		 	->getManager()
		 	->getRepository('PHuNPlatformBundle:Plugin')
		 ;

		$xsl_header = "xsl/html2xml_header.phun";
		$xsl_stylesheet = file_get_contents($xsl_header);
		
		// On récupère l'entité correspondante à l'id $id
		$listPlugin = $repository->findAll();
		foreach ($listPlugin as $plugin) {
			$pluginName = $plugin->getName();

			$replace = $pluginName;
			$fileName 	= "xsl/html2xml_template.phun";
			if(is_file($fileName)){
				$content = file_get_contents($fileName);
			}
			
			$search = "p*h*u*n";
			$matched = str_replace($search, $replace, $content);
			$xsl_stylesheet .= $matched;
		}
		
		$xsl_stylesheet .= '</xsl:stylesheet>';

		file_put_contents($fileName_result, $xsl_stylesheet);

		return new Response("Votre nouveau schema de metadonnées Html2Xml a bien été créé !");
	}

	public function createXSLTemplate_Xml2HtmlAction()
	{
		$fileName_result = "xsl/xsl_gen/xml2html.xsl";

		// Repository de la table page
		 $repository = $this->getDoctrine()
		 	->getManager()
		 	->getRepository('PHuNPlatformBundle:Plugin')
		 ;

		$xsl_header = "xsl/xml2html_header.phun";
		$xsl_stylesheet = file_get_contents($xsl_header);
		
		// On récupère l'entité correspondante à l'id $id
		$listPlugin = $repository->findAll();
		foreach ($listPlugin as $plugin) {
			$pluginName = $plugin->getName();

			$replace = $pluginName;
			$fileName 	= "xsl/xml2html_template.phun";
			if(is_file($fileName)){
				$content = file_get_contents($fileName);
			}
			
			$search = "p*h*u*n";
			$matched = str_replace($search, $replace, $content);
			$xsl_stylesheet .= $matched;
		}
		
		$xsl_stylesheet .= '</xsl:stylesheet>';

		file_put_contents($fileName_result, $xsl_stylesheet);

		return new Response("Votre nouveau schema de metadonnées Xml2Html a bien été créé !");

	}




	public function AddPluginAction($id, Request $request)
    {
    	//$plugin = new Plugin();
	    $em = $this->getDoctrine()->getManager();
    	$corpus = $em->getRepository('PHuNPlatformBundle:Corpus')->find($id);
	    $form = $this->get('form.factory')->create(new ElementType(), $corpus);

		if ($form->handleRequest($request)->isValid()) {
			$em = $this->getDoctrine()->getManager();
	    	$em->persist($corpus);
	    	$em->flush();

	    	$request->getSession()->getFlashBag()->add('notice', 'L\'élément a bien été créé.');
	    
	    	$this->PluginCreationAction(1);
	    	$this->generationXSLAction();
	    }

	    return $this->render('PHuNPlatformBundle:Plugin:add_plugin.html.twig', array(
	      'form' => $form->createView() )
	    );
    }


	// Creation of a plugin according to the plugin name $pluginName
	public function createPlugin_fromStr($pluginName) // $pluginName = "biffe"
	{
		// Plugin template is opened
		// Contain TinyMCE plugin template
		$templatePlugin_fileName = "plugin_template.p";
		$templatePlugin_content = file_get_contents($templatePlugin_fileName);

		// Good plugin name
		$pluginName_lower = strtolower($pluginName);	// biffe
		$pluginName_upper = ucfirst($pluginName_lower);	

		// Find of m*** and M*** and replace with lower and upper plugin name
	    $search = array( "m***", "M***");
		$replace = array($pluginName_lower, $pluginName_upper);
		$plugin_content = str_replace($search, $replace, $templatePlugin_content);

		// Creation of the folder associated to the plugin
		$folder_name = "bundles/stfalcontinymce/vendor/tinymce/plugins" . "/" . $pluginName_lower;
		if(!is_dir($folder_name)){
			mkdir($folder_name);
		}

		// Put the plugin into the folder
		$plugin_fileName = $folder_name . "/" . "plugin.min.js";
		file_put_contents($plugin_fileName, $plugin_content);
	}



	public function PluginCreationAction($id)
	{
		// Repository de la table page
		 $repository = $this->getDoctrine()
		 	->getManager()
		 	->getRepository('PHuNPlatformBundle:Plugin')
		 ;
		
		// On rmet à jour l'ensemble des plugins de la bdd
		$listPlugin = $repository->findAll();
		foreach ($listPlugin as $plugin) {
			$pluginName = $plugin->getName();
			$this->createPlugin_fromStr($pluginName);
		}

		return new Response("tinyMCE plugin generated");
	}

	
}