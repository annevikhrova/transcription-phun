<?php

namespace PHuN\PlatformBundle\Controller;

use PHuN\PlatformBundle\Editor\EditorConfig; 
use PHuN\PlatformBundle\Form\PluginType;
use PHuN\PlatformBundle\Form\CorpusType;
use PHuN\PlatformBundle\Form\ElementType;
use PHuN\PlatformBundle\Entity\Corpus;
use PHuN\PlatformBundle\Entity\Plugin;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse; //important for RedirectResponse
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
		
		// Repository de la table plugin
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
		
		// Repository de la table plugin
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
	
	
	
	/**
	* Adds plugin from form
	* @param integer $id for corpus
	* @param Request $request
	*/
	public function AddPluginAction($id, Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$corpus = $em->getRepository('PHuNPlatformBundle:Corpus')->find($id);
		$form = $this->get('form.factory')->create(new ElementType(), $corpus);
		
		if ($form->handleRequest($request)->isValid()) {
			
			$em = $this->getDoctrine()->getManager();
			$em->persist($corpus);
			$em->flush();
			
			$request->getSession()->getFlashBag()->add('notice', 'L\'élément a bien été créé.');
			
			$this->PluginCreationAction($id); // 1
			$this->generationXSLAction();
			
			$listPlugins = $corpus->getPlugins();
			$stylesheet  = $corpus->getStylesheet()->getUrl();
			$containerList = $this->getDoctrine()
				->getManager()
				->getRepository('PHuNPlatformBundle:Container')
				->findAll();    
			$editConfig = new EditorConfig($listPlugins, $stylesheet, $containerList);
			$tiny_config = $editConfig->createEditorConfig();
			
			$tiny_config_file = "corpus/config/editor_". $corpus->getName(). ".json";
			$cf = file_put_contents($tiny_config_file, $tiny_config);
			
			return $this->render('PHuNPlatformBundle:Admin:saved.html.twig', array('corpus' => $corpus));
			
		}
		
		return $this->render('PHuNPlatformBundle:Plugin:add_plugin.html.twig', array(
			'form' => $form->createView(),
			'corpus' => $corpus )
		);
	}
	
	
	public function PluginCreationAction($id)
	{
		// Repository de la table page
		$em = $this->getDoctrine()->getManager();
		//$repository = $em->getRepository('PHuNPlatformBundle:Plugin'); //test
		
		//Test code for plugin generation based on corpus 
		$repository = $em->getRepository('PHuNPlatformBundle:Corpus');
		$corpus = $repository->findOneBy(array('id' => $id )); 
		$listPlugin = $corpus->getPlugins();
		$standardPluginList = array('alinéa', 'italique', 'gras', 'raturé', 'souligné', 'exposant', 'gauche', 'centré', 'droit', 'code', 'table'); // will not be modified
		/////end///
		
		foreach ($listPlugin as $plugin) {
			if( in_array($plugin->getName(), $standardPluginList) ) {
				//Do nothing.
			}
			else { 
				// Update all plugins in list to database
				$pluginName = strtolower($plugin->getName());
				//strtolower($pluginName);
				$plugin->setName($pluginName);
				$pluginDesc = $plugin->getDescription();
				$plugin->setDescription($pluginDesc);
				
				$em->persist($plugin);
				$em->flush();
				//create new plugin js for plugin
				$this->createPlugin_fromStr($pluginName, $pluginDesc);
			}
		}
		
		return new Response("tinyMCE plugin generated");
	}
	
	/**
	* Creation of a plugin according to the plugin name $pluginName
	* @param string $pluginName
	*/
	public function createPlugin_fromStr($pluginName, $pluginDesc) // $pluginName = "biffe"
	{
		// Plugin template is opened
		// Contain TinyMCE plugin template
		$templatePlugin_fileName = "plugin_template.p";
		$templatePlugin_content = file_get_contents($templatePlugin_fileName);
		
		// Correct plugin name :)
		$pluginName_lower = strtolower($pluginName);	// biffe
		$pluginName_upper = ucfirst($pluginName_lower);	
		$pluginName_upper  = str_replace("_", " ", $pluginName_upper);
		
		// Si description vide
		if ( $pluginDesc == null ) {
			$pluginDesc = $pluginName_upper;
		}
		
		$pluginDescNew = addslashes($pluginDesc);
		
		// Check for accentuated characters
		$find = array("é", "è", "à", "â", "ë", "ê", "ö", "ô", "ù","ï", "î", " ");
		$replace = array("e", "e", "a", "a", "e", "e", "o", "o", "u", "i", "i", "_");
		$pluginName_lower_noAccent = str_replace($find, $replace, $pluginName_lower);
		
		// Find m*** and M*** and replace with lower and upper plugin name
		$search = array( "m***", "M***", "mna***", "*description*");
		$replace = array($pluginName_lower, $pluginName_upper, $pluginName_lower_noAccent, $pluginDescNew);
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
	
}