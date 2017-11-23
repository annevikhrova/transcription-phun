<?php

namespace PHuN\PlatformBundle\Controller;

use PHuN\PlatformBundle\Entity\Corpus;
use PHuN\PlatformBundle\Entity\Page;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\DependencyInjection\SimpleXMLElement;

class SearchController extends Controller
{ 


    public function MenuAction()
	{
	    return $this->render('PHuNPlatformBundle:Search:menu.html.twig');
	}

	public function RunAction($searchStr)
	{
		$em = $this->getDoctrine()->getManager();

		// Search on all page
		$listPages = $em->getRepository('PHuNPlatformBundle:Page')->findAll();

		$retrievedList = array();
		$str_length = count($searchStr);

		// Search for the string in all pages
		foreach ($listPages as $page)
		{
			// Get xml content as text
			$xml_content = $this->ReformatXml($page->getUrlXml());

			// Find occurence of search string
            $begin = strpos($xml_content, $searchStr, 0);
			while( $begin !== false )
			{
				$context = substr($xml_content, $begin-30, $str_length + 60);
				$retrievedList[] = array(
					"page"		=> $page,
					"context"	=> $context);
                                
                            $begin = strpos($xml_content, $searchStr, $begin + 1);
			}
		}


		return $this->render('PHuNPlatformBundle:Search:result.html.twig',
			array(
				'searchStr' => $searchStr,
				'retrievedList' => $retrievedList));
	}


	/**
	 * @function ReformatXml
	 * Reformat a XML file
	 *
	 * @param	urlXml 	XML, defined by its url
	 * @return	String containing content without xml elements
	 */
	private function ReformatXml($urlXml)
	{
		$xmlContent;
		if(is_file($urlXml))
		{
                        /*
			$contenu_xml = simplexml_load_file($urlXml);
			$contenu = $contenu_xml->contenu;
			$xmlContent = $contenu->__toString();
                        */
                        $xmlContent = file_get_contents($urlXml);
		}        
                        
		else
            $xmlContent = "";
                

		return $xmlContent;
	}
}
