<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace PHuN\PlatformBundle\Controller;

use PHuN\PlatformBundle\Form\SousDossierType;
use PHuN\PlatformBundle\Entity\SousDossier;

use PHuN\PlatformBundle\Form\DossierType;
use PHuN\PlatformBundle\Entity\Dossier;

use PHuN\PlatformBundle\Form\CatalogueType;
use PHuN\PlatformBundle\Entity\Catalogue;

use PHuN\PlatformBundle\Form\CorpusType;
use PHuN\PlatformBundle\Entity\Corpus;

use PHuN\PlatformBundle\Entity\Page;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse; 
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

use diffMatchPatch\src\DiffMatchPatch;

class XMLController extends Controller
{
    /**
     * Function that select a thing and to thing with it
     * @param number $id Unique id of a given corpus.
     */
    public function selectXMLAction($id) {
        
        $em = $this->getDoctrine()->getManager();
        
        $catalogueList = $em->getRepository('PHuNPlatformBundle:Catalogue')
            ->findByCorpus($id);
        $corpus = $em->getRepository('PHuNPlatformBundle:Corpus')
            ->findOneById($id);   
        $corpusId = $corpus->getId();
        //$associatedCatalogue;// = array( "catalogue", array("dossier", array("sousDossier") ) ) ;
        
        $corpusName = $corpus->getName() .'_'. $corpus->getId();
        
        $path = 'corpus/'.$corpusName. '/transcriptions/';
        
        $dir = new \DirectoryIterator($path);
        $listTranscriptionDir = array();
        foreach ($dir as $fileinfo) {
            if ($fileinfo->isDir() && !$fileinfo->isDot()) {
                //echo $fileinfo->getFilename().'<br>';
                $listTranscriptionDir[] = $path . $fileinfo->getFilename() . '/';
            }
        }
        
        $associatedDossier = array();
        foreach ($listTranscriptionDir as $transcriptionDir) {
            $dir = new \DirectoryIterator($transcriptionDir);
            
            $listFullPathTranscriptionFile = array();
            foreach ($dir as $fileinfo) {
                if ($fileinfo->isFile()) {
                    //echo $fileinfo->getFilename().'<br>';
                    preg_match('/transcriptions\/(.*)/', $transcriptionDir, $doss);
                    $dossname = rtrim($doss[1], '/');
                    $name = $transcriptionDir . $fileinfo->getFilename();
                    $listFullPathTranscriptionFile[] = array("name" => $name);
                    
                    //$listXmlFiles[] = $name;
                }
            }
            $associatedDossier[] = array( "dossier" => $transcriptionDir, "dossname" => $dossname, "associatedFile" => $listFullPathTranscriptionFile);
        }
        
        //return new Response (var_dump($associatedDossier));
        
        return $this->render(
            'PHuNPlatformBundle:Metrology:select.html.twig',
            array(
                'corpus' => $corpus,
                'corpusId' => $corpusId,
                'associatedDossier' => $associatedDossier,
                
            ));
    }
    
//    public function viewXMLAction($xml) {
//        //return new Response($xml); 
//        $file = file_get_contents($xml);
//        
//        return new Response($file);
//        
//    }
//    
//    public function downloadXMLAction($xml) {
//        //return new Response($xml); 
//        $file = file_get_contents($xml);
//        
//        return new Response($file);
//        
//    }
    
    public function analyseXMLAction($xmls, $doss, $id) {
        //return new Response($xml); 
        
        
        $em = $this->getDoctrine()->getManager();
        $corpus = $em->getRepository('PHuNPlatformBundle:Corpus')
            ->findOneById($id);
        $corpusName = $corpus->getName(). '_' . $corpus->getId();
        $path = 'corpus/' . $corpusName . '/transcriptions/'. $doss . '/vfiles/';
        
        if(!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        
        foreach ($xmls as $xml) {
            $file = file_get_contents($xml);
            
            //clean file from encoding to retain text (file.v)
            $v = strip_tags($file);
            $subpath = $path.$doss.'.v';
            file_put_contents($subpath, $v);
            //add resulting file to array for comparison with all other files
            
        }
        
        
        
    }
    
    public function testXMLAction($id) { //parameters to add : $xmls, $doss, $id(corpus id)
        //return new Response($xml); 
        $xmls = array('corpus/Benoîte Groult_5/transcriptions/31AF19001_03_009/31AF19001_03_009_93.xml', 'corpus/Benoîte Groult_5/transcriptions/31AF19001_03_009/31AF19001_03_009_94.xml');
        $doss = '31AF19001_03_009';
        $em = $this->getDoctrine()->getManager();
        $corpus = $em->getRepository('PHuNPlatformBundle:Corpus')
            ->findOneById($id);
        $corpusName = $corpus->getName(). '_' . $corpus->getId();
        //$path = 'corpus/' . $corpusName . '/transcriptions/'. $doss . '/vfiles/';
        $path = $corpusName . '/transcriptions/'. $doss . '/vfiles/';
        
        if(!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        
        foreach ($xmls as $xml) {
            $file = file_get_contents($xml);
            preg_match('/31AF19001_03_009\/(.*)/', $xml, $filename);
            $filename = substr($filename[1], 0, -4);
            //clean file from encoding to retain text (file.v)
            $v = strip_tags($file);
            $vfile = $path . $filename .'.v';
            file_put_contents($vfile, $v);
            
            //add resulting files to array for comparison with all other files
            $listVFiles[] = $vfile;
        }
        //return $listVFiles;
        
        // Diff engine
        $dmp = new DiffMatchPatch();
        
        //compare files
        $distanceMatrix = array();
        $distanceMatrixStr = "";
        for($i=0 ; $i<count($listVFiles); $i++) {
            $distanceMatrixStr .= $listVFiles[$i] . ",";
            $row = array();
            for($j=0 ; $j<count($listVFiles); $j++) {
               //appliquer fonction de comparaison
               $file_i = file_get_contents($listVFiles[$i]);
               $file_j = file_get_contents($listVFiles[$j]);

               //la fonction php de calcule de distance (cf google) 
               $raw_diff = $dmp->diff_main($file_i, $file_j, false);
               
               $deletion_number = 0;
               $addition_number = 0;
               foreach($raw_diff as $element) {
                   if($element[0] == -1 ) {
                       $deletion_number++;
                   }
                   if($element[0] == 1 ) {
                       $addition_number++;
                   }
               }
               
               $distance = $addition_number + $deletion_number;
               $distanceMatrixStr .= $distance . ",";
               
               //ajout a la matrice
               $row[] = $distance;

               //Documenter distances dans un fichier indexé pour chaque text traité
               if($distance == 0) {

               }
            }
            $distanceMatrixStr .= "\n";
            $distanceMatrix[] = $row;
        }
        
        $csv_folder = $corpusName . '/transcriptions/'. $doss .'/csv/';
        if(!file_exists($csv_folder)) {
            mkdir($csv_folder, 0777, true);
        }
        $csv_path = $csv_folder .'distance_matrix.csv';
        file_put_contents($csv_path, $distanceMatrixStr);
        
        return new Response($csv_path);
        
        
        
    }
    
}

