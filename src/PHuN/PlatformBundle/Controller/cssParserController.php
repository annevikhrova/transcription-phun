<?php
/*
 *  Réalisation du site  dans le cadre d'un projet de thèse    
 *  soutenu par l'ARC 5 2014 (Région Rhône-Alpes)			   
 *  pour le projet PHuN - Patrimoines et Humanités Numériques  
 *  Author : Anne Vikhrova, Decembre 2015					   
 */

namespace PHuN\PlatformBundle\Controller;

use PHuN\PlatformBundle\Form\PluginType;
use PHuN\PlatformBundle\Form\CorpusType;
use PHuN\PlatformBundle\Entity\Corpus;
use PHuN\PlatformBundle\Entity\Plugin;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse; //important use à déclarer pour l'utilisation de RedirectResponse
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Doctrine\ORM\EntityManager;


class cssParserController extends Controller
{
	// Entity manager
	private $em;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
	}

	// Filename of the css
	public $fn_css;

	// List of all lines in $fn_dtd
	public $results1 = [];
        public $results2 = [];
        
        
        public $styleList = [];
        
        //public $newSCList = [];
        
        //public $newSDList = [];
        
        
        public function setCssFn($fn) { $this->fn_css = $fn; }
        
        public function getResults() {
            return $this->results;
        }

	// Detect all elements inside the dtd
	public function detectElements($idCorpus)
	{
            // All lines are treated
		$em = $this->em;
		$corpus = $em->getRepository('PHuNPlatformBundle:Corpus')->find($idCorpus);
                
                $newSC_str = "";
                $newSD_str = "";
                
                //echo count($this->styleList) ."\n";
                
		foreach( $this->styleList as $style )
                {
                    $styleName    = $style["name"];
                    $styleContent = $style["content"];
                    
                    if( $styleName[0] == "." || ( substr($styleName, 0, 3) == "div" ) ) {
                        $replace_class_str = $styleName." {" . $styleContent . "} \n\n";
                    }
                    else {
                        $replace_class_str = "." . $styleName." {" . $styleContent . "} \n\n";
                    
                    
                        $newSC_str .= $replace_class_str;
                    
                        $replace_div_str = "div[id=".$styleName . "] " . " {".$styleContent . "}\n\n";
                        $newSD_str .= $replace_div_str;
                    }
		}
                
            
            $newContents = "\n/* Class Styles for html markup */\n" . $newSC_str. "\n/* Div Styles for Toolbar */\n". $newSD_str ;
            //return new Response($newContents);
            file_put_contents($this->fn_css, $newContents);
        }
        
        // Function that creates a line for each <  BLABLA > found in the dtd file
	public function splitFile()
	{
            $fileContent = file_get_contents( $this->fn_css );
            
//            echo strlen($fileContent) . "\n\n";
            
            for( $i = 0; $i < strlen($fileContent)-1; $i++ )
            {
                
                while( $fileContent[$i] == "\n" 
                        || $fileContent[$i] == "\r"
                        || $fileContent[$i] == "\t" 
                        || $fileContent[$i] == " " ){
                    $i++;
                    if( $i >= strlen($fileContent)-1 )
                        return;
                }
                
                if( substr( $fileContent, $i, 2 ) == "/*" ){
                    while( substr( $fileContent, $i, 2 ) != "*/" )
                    {
                        $i++;
                    }
                    $i += 2;
                    while( $fileContent[$i] == "\n" 
                            || $fileContent[$i] == "\r"
                            || $fileContent[$i] == "\t" 
                            || $fileContent[$i] == " " ){
                        $i++;
                        if( $i >= strlen($fileContent)-1 )
                            return;
                    }
                }
                
                $begin = $i;
                while( $fileContent[$i] != "{"){
                    $i++;
                    if( $i >= strlen($fileContent)-1 )
                        return;
                }
                
                $end = $i;
                $newStyleName = substr( $fileContent, $begin, $end - $begin );
                
                $begin = $i + 1;
                while( $fileContent[$i] != "}"){
                    $i++;
                    if( $i >= strlen($fileContent)-1 )
                        return;
                }
                $end = $i;
                $newStyleContent = substr( $fileContent, $begin, $end - $begin );
                
                $this->styleList[] = array( "name" => $newStyleName, "content" => $newStyleContent );
            }
            
            return new Response(var_dump($this->styleList));
            
	}

        public function parseCssFileAction($cssFile, $idCorpus)
	{
		$this->fn_css = $cssFile;

		$this->splitFile();
		$this->detectElements($idCorpus);
		
		return new Response("Ecriture réussie");
	}
}        