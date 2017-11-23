<?php

//  Réalisation du site  dans le cadre d'un projet de thèse    //
//  soutenu par l'ARC 5 2014 (Région Rhône-Alpes)			   //
//  pour le projet PHuN - Patrimoines et Humanités Numériques  //
//  Author : Anne Vikhrova, Decembre 2015					   //

namespace PHuN\PlatformBundle\Controller;

use PHuN\PlatformBundle\Form\PluginType;
use PHuN\PlatformBundle\Form\CorpusType;
use PHuN\PlatformBundle\Entity\Corpus;
use PHuN\PlatformBundle\Entity\Plugin;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse; //important for RedirectResponse
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Doctrine\ORM\EntityManager;

class element
{
	// Name of element
	public $name;

	// List of dependence
	public $dependenceList = [];

	public function setName($name) { $this->name = $name; }
	public function getName() { return $this->name; }
	public function addDependence($dependence) { $dependenceList[] = $dependence; }
}

class dtdParserController extends Controller
{
	// Entity manager
	private $em;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}

	// Filename of the dtd
	public $fn_dtd;

	// List of all lines in $fn_dtd
	public $listLines = [];

	// List of all elements in the $fn_dtd
	public $listElements = [];

	/**
	 * Detect all elements inside the dtd
	 * Uses auxiliary function createPlugin_fromStr from Plugin Controller
     * @param integer $idCorpus
     */
	public function detectElements($idCorpus)
	{

	// Find all elements in the DTD and create the associated plugin

		$str2match = "<!ELEMENT";
		$str2match_lgth = strlen($str2match);

		// All lines are treated
		$em = $this->em;
		$corpus = $em->getRepository('PHuNPlatformBundle:Corpus')->find($idCorpus);

		foreach ($this->listLines as $line) {

			$eltPos = strpos($line, $str2match);
			if($eltPos === false){
				// Do nothing as nothing has been detected/
			}
			else{
				$elt = new element;
				$plugin = new Plugin();

				// An element has been detected:
				// Position of the element name
				$eltName_startPos = $eltPos + $str2match_lgth + 1;
				$cut_line = substr($line, $eltName_startPos);
				$eltName_size = strpos($cut_line, " ");
				$eltName = substr($line, $eltName_startPos, $eltName_size);
					
				$elt->setName($eltName);
				$this->listElements[] = $elt; //
				echo $elt->name . ' | ' ;

				$plugin->setName($elt->name);

				$em->persist($plugin);
					
				$corpus->addPlugin($plugin);
				$em->flush();

				$em->persist($corpus);
				//$response = $this->forward('PHuNPlatformBundle:Plugin:createPlugin_fromStr', array('pluginName' => $eltName));
				// $this->createPlugin_fromStr($elt->name);
				$this->forward('PHuNPlatformBundle:Plugin:createPlugin_fromStr', array('pluginName' => $elt->name, 'pluginDesc' => $elt->name));
	
			}
		}

		$this->generationXSLAction();
	}

	/**
     * Function that creates a line for each < ELEMENT > found in the dtd file
     */
	public function splitFile()
	{
		$content = file_get_contents($this->fn_dtd);

		preg_match_all('<.*>', $content, $result);
		$this->listLines = array_filter($result[0]);

		return $this->listLines;
	}

	public function setDtdFn($fn) { $this->fn_dtd = $fn; }


	/**
	 * Creation of a plugin according to the plugin name $pluginName
	 * @param string $pluginName
     */
	public function createPlugin_fromStr($pluginName) // $pluginName = "biffe"
	{
		// Plugin template is opened
		// Contains TinyMCE plugin template
		$templatePlugin_fileName = "plugin_template.p";
		$templatePlugin_content = file_get_contents($templatePlugin_fileName);

		// correct plugin name
		$pluginName_lower = strtolower($pluginName);	// example : biffe
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


	public function generationXSLAction()
	{
		$this->createXSLTemplate_Html2XmlAction();
		return new Response ("Réussie !");
	}

	public function createXSLTemplate_Html2XmlAction()
	{
		$fileName_result = "xsl/xsl_gen/html2xml.xsl";
		
		$repository = $this->em->getRepository('PHuNPlatformBundle:Plugin');

		$xsl_header = "xsl/html2xml_header.phun";
		$xsl_stylesheet = file_get_contents($xsl_header);
		
		// Recovery of plugin list
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

		file_put_contents($fileName_result, $xsl_stylesheet);

		return new Response("Votre nouveau schema de metadonnées Html2Xml a bien été créé !");
	}

	public function createXSLTemplate_Xml2HtmlAction()
	{
		$fileName_result = "xsl/xsl_gen/xml2html.xsl";

		$repository = $this->em->getRepository('PHuNPlatformBundle:Plugin');

		$xsl_header = "xsl/xml2html_header.phun";
		$xsl_stylesheet = file_get_contents($xsl_header);
		
		// Recovery of plugin list
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

		file_put_contents($fileName_result, $xsl_stylesheet);

		return new Response("Votre nouveau schema de metadonnées Xml2Html a bien été créé !");

	}

	/**
	* Launch supporting functions splitFile() and detectElements()
	*/
	public function parseDtdFileAction($dtdFile, $idCorpus)
	{
		$this->fn_dtd = $dtdFile;

		$list = $this->splitFile();
		$list = $this->detectElements($idCorpus);
		
		return new Response("Ecriture réussie");
	}
}

