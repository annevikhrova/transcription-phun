<?php
// src/PHuN/UserBundle/DataFixtures/ORM/LoadPage.php

namespace PHuN\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PHuN\PlatformBundle\Entity\Page;
use PHuN\PlatformBundle\Entity\Catalogue;
use PHuN\PlatformBundle\Entity\Dossier;
use PHuN\PlatformBundle\Entity\SousDossier;
use Symfony\Component\Finder\Finder;


class LoadPage implements FixtureInterface
{
    
    
    public function load(ObjectManager $manager)
    {
      
        // Find appropriate corpus
        $corpus = $manager->getRepository('PHuNPlatformBundle:Corpus')
                          ->find(6);
      
        $listCatalogue = $manager->getRepository('PHuNPlatformBundle:Catalogue')
                                 ->findByCorpus( $corpus );
        
        echo "Number of detected catalogues: " . count( $listCatalogue ) . "\n";
        
        $listPage = $manager->getRepository('PHuNPlatformBundle:Page')
                                           ->findByCorpus( $corpus );
//        foreach( $listPage as $page )
//        {
//            $listTranscription = $manager->getRepository('PHuNPlatformBundle:Transcription')
//                                   ->findByPage( $page );
//            foreach( $listTranscription as $transcription )
//            {
//                $manager->remove( $transcription );
//            }
//
//            $manager->remove( $page );
//        }
        
        
        
//        foreach( $listCatalogue as $catalogue )
//        {
//            $listDossier = $manager->getRepository('PHuNPlatformBundle:Dossier')
//                                   ->findByCatalogue( $catalogue );
//      
//            foreach( $listDossier as $dossier )
//            {
//                $listSousDossier = $manager->getRepository('PHuNPlatformBundle:SousDossier')
//                                           ->findByDossier( $dossier );
//      
//                foreach( $listSousDossier as $sousDossier )
//                {
//                    
//                    
//                    $manager->remove( $sousDossier );
//                }
//                $manager->remove( $dossier );
//            }
//            $manager->remove( $catalogue );
//        }
//        
//        $manager->flush();
      
        
        // Find appropriate corpus
        $corpus = $manager->getRepository('PHuNPlatformBundle:Corpus')
                          ->find(6); //Find corpus by id
      
        $listCatalogue      = $manager->getRepository('PHuNPlatformBundle:Catalogue')->findAll();
        $listDossier        = $manager->getRepository('PHuNPlatformBundle:Dossier')->findAll();
        $listSousDossier    = $manager->getRepository('PHuNPlatformBundle:SousDossier')->findAll();
        
        echo "Number of detected catalogues:\t" . count( $listCatalogue ) . "\n";
        echo "Number of detected dossiers:\t" . count( $listDossier ) . "\n";
        echo "Number of detected sous-dossiers:\t" . count( $listSousDossier ) . "\n";
      
        $project_name = $corpus->getName().'_'.$corpus->getId();
        //$project_name = $corpus->getName();

         // Dossier originel contenant les images
         $folder_name_images = '/Applications/MAMP/htdocs/Symfony/web/corpus/'.$project_name.'/images';
         //$folder_name_images = '/var/www/html/phun/Symfony/web/corpus/'.$project_name.'/images';
         echo $project_name.'\t';
         $fn_img_length = strlen($folder_name_images);

         // Nom des images pour les twig
         $folder_name_img_db = 'corpus/'.$project_name.'/images';		// Dossier contenant les images
         $folder_name_img_thumbs_db = 'corpus/'.$project_name.'/thumbs';	// Dossier contenant les miniatures des images
         $folder_name_xml_db = 'corpus/'.$project_name.'/xml';			// Dossier contenant les fichiers XML

         // On cherche toutes les images du corpus
         $finder     = new Finder();
         $listUrlImg = $finder->name('*.jpg')->in($folder_name_images);

         // Prototype des url des images :
         // 301-1-1-005  = catalogue-dossier-sousdossier-page
         // On peuple en Premier les catologues
//         $listCatalogue     = $manager->getRepository('PHuNPlatformBundle:Catalogue')->findAll();
//         $listDossier       = $manager->getRepository('PHuNPlatformBundle:Dossier')->findAll();
//         $listSousDossier   = $manager->getRepository('PHuNPlatformBundle:SousDossier')->findAll();

         $listUrlSize = count($listUrlImg);
         $i = 0;
   

        foreach ($listUrlImg as $urlImg)
        {
            $i = $i + 1;
            $pct = $i / $listUrlSize * 100;
            echo $pct . "%\t\n";

            // On récupére le nom du fichier
            $alt = substr($urlImg, $fn_img_length+1);
            $alt = substr($alt, 0, -4);

            // On split le nom du fichier
//            $splitAlt = preg_split("/(-|_)/", $alt);
            $splitAlt = preg_split("/(_|-)/", $alt);

            $catalogue_name = "";
            $dossier_name = "";
            $sous_dossier_name = "";
            $page_name = "";
            if( count($splitAlt) == 4 )
            {
                $catalogue_name     = $splitAlt[0];
                $dossier_name       = $splitAlt[1];
                $sous_dossier_name  = $splitAlt[2];
                $page_name          = $splitAlt[3];
            }
            else if ( count($splitAlt) == 3 )
            {
                $catalogue_name     = $splitAlt[0];
                $dossier_name       = $splitAlt[1];
                $sous_dossier_name  = "unnamed";
                $page_name          = $splitAlt[2];

            }
            else if ( count($splitAlt) == 2 )
            {
                $catalogue_name     = $splitAlt[0];
                $dossier_name       = "unnamed";
                $sous_dossier_name  = "unnamed";
                $page_name          = $splitAlt[1];

            }
            else if ( count($splitAlt) == 5 )
            {
                $catalogue_name     = $splitAlt[0];
                $dossier_name       = $splitAlt[1];
                $sous_dossier_name  = $splitAlt[2];
                $page_name          = $splitAlt[3] . '_' . $splitAlt[4];

            }
//            echo "\tcatalogue:\t" . $catalogue_name . "\n";
//            echo "\tdossier:\t" . $dossier_name . "\n";
//            echo "\tsous do:\t" . $sous_dossier_name . "\n";
//            echo "\tPage\t: " . $page_name . "\n";
            
            // Handle catalogue
            $catalogue = new Catalogue();
            $catalogue->setCorpus( $corpus );
            $catalogue->setName( $catalogue_name );
            
            // Check if catalogue, dossier, sous dossier and page is already in list, if not add it
            $is_catalogue_in_db = false;
            for( $j = 0; $j < count($listCatalogue); $j++ )
            {
                if(     ( $listCatalogue[$j]->getName() == $catalogue_name ) 
                     && ( $listCatalogue[$j]->getCorpus() == $corpus ) )
                {
                    $is_catalogue_in_db = true;
                    $catalogue = $listCatalogue[$j];
                }
            }
            
            if( !$is_catalogue_in_db )
            {
                $listCatalogue[] = $catalogue;
                $manager->persist($catalogue);
            }
            
            
            // Handle dossier
            $dossier = new Dossier();
            $dossier->setCatalogue( $catalogue );
            $dossier->setName( $dossier_name );
            
            // Check if catalogue, dossier, sous dossier and page is already in list, if not add it
            $is_dossier_in_db = false;
            for( $j = 0; $j < count($listDossier); $j++ )
            {
                if(     ( $listDossier[$j]->getName() == $dossier_name ) 
                     && ( $listDossier[$j]->getCatalogue() == $catalogue ) )
                {
                    $is_dossier_in_db = true;
                    $dossier = $listDossier[$j];
                }
            }
            
            if( !$is_dossier_in_db )
            {
                $listDossier[] = $dossier;
                $manager->persist($dossier);
            }
            
            
            // Handle sous-dossier
            $sous_dossier = new SousDossier();
            $sous_dossier->setDossier( $dossier );
            $sous_dossier->setName( $sous_dossier_name );
            
            // Check if catalogue, dossier, sous dossier and page is already in list, if not add it
            $is_sous_dossier_in_db = false;
            for( $j = 0; $j < count($listSousDossier); $j++ )
            {
                if(     ( $listSousDossier[$j]->getName() == $sous_dossier_name ) 
                     && ( $listSousDossier[$j]->getDossier() == $dossier ) )
                {
                    $is_sous_dossier_in_db = true;
                    $sous_dossier = $listSousDossier[$j];
                }
            }
            
            if( !$is_sous_dossier_in_db )
            {
                $listSousDossier[] = $sous_dossier;
                echo "\tAdded sous-dossier\t: " . $sous_dossier->getName() . "\n";
                $manager->persist($sous_dossier);
            }
            
            
            // Handle page
            $listPage = $manager->getRepository('PHuNPlatformBundle:Page')->findBySousdossier($sous_dossier);
            
            $page = new Page();
              $page->setSousDossier($sous_dossier);

              $path_url_img 	   = $folder_name_img_db . '/' . $alt . '.jpg';
              $path_url_img_thumbs = $folder_name_img_thumbs_db . '/' . $alt . '.jpg';
              $path_url_xml        = $folder_name_xml_db . '/' . $alt . '.xml';

              $page->setFileName($alt);
              $page->setAlt( $page_name );
              $page->setUrlImg($path_url_img);
              $page->setThumb($path_url_img_thumbs);
              $page->setUrlXml($path_url_xml);
              $page->setCorpus($corpus);
              $page->setPublished(0);
              $page->setIdPublishedTranscription(0);
              echo "\tNew page: " . $path_url_img . "\n";
            
            // Check if catalogue, dossier, sous dossier and page is already in list, if not add it
            $is_page_in_db = false;
            for( $j = 0; $j < count($listPage); $j++ )
            {
                if(     ( $listPage[$j]->getAlt() == $page_name ) 
                     && ( $listPage[$j]->getSousDossier() == $sous_dossier ) )
                {
                    $is_page_in_db = true;
                    $page = $listPage[$j];
                echo "\tIs already in db\t: " . $page->getAlt() . "\n";
                }
            }
            
            if( !$is_page_in_db )
            {
                $listPage[] = $page;
                echo "\tAdded page\t: " . $page->getAlt() . "\n";
                $manager->persist($page);
            }
            $manager->flush();
            
        }
        $manager->flush();
         
         
}
}

