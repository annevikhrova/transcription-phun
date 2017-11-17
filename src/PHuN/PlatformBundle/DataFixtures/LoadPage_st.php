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

    // On peuple le corpus Stendhal
   $corpus = $manager->getRepository('PHuNPlatformBundle:Corpus')->find(1);

    // Dossier originel contenant les images
    $folder_name_images = '/Applications/MAMP/htdocs/Symfony/web/corpus/Stendhal/images';
    $fn_img_length = strlen($folder_name_images);

    // Nom des images pour les twig
    $folder_name_img_db = 'corpus/Stendhal/images';
    $folder_name_xml_db = 'corpus/Stendhal/xml';

    // On cherche toutes les images du corpus
    $finder     = new Finder();
    $listUrlImg = $finder->name('*.jpg')->in($folder_name_images);

    // Prototype des url des images :
    // 301-1-1-005  = catalogue-dossier-sousdossier-page
    // On peuple en Premier les catologues
    $listCatalogue     = array();
    $listDossier       = array();
    $listSousDossier   = array();
    $listPage          = array();

    $listUrlSize = count($listUrlImg);
    $i = 0;

    foreach ($listUrlImg as $urlImg){
      $i = $i + 1;
      $pct = $i / $listUrlSize * 100;
      echo "% of DB prepared: " . $pct . "%\t";

      // On récupére le nom du fichier
      $alt = substr($urlImg, $fn_img_length+1);
      $alt = substr($alt, 0, -4);

      // On split le nom du fichier
      $splitAlt = preg_split("/(-|_)/", $alt);
      echo "name: " . $alt;


      /**************************
       *
       * Traitemenent dans le cas ou length(splitAlt) = 4  => 301-1-1-005 
       *
       **************************/

      if(count($splitAlt) == 4){
            // On vérifie l'existence du catologue
            $isCatalogueExist = false;
            foreach ($listCatalogue as $catalogue) {
              if( strcmp($catalogue, $splitAlt[0]) == 0 ){
                $isCatalogueExist = true;
              }
            }

            // Si le catalogque n'existe pas, on l'ajoute dans la DB et dans la liste
            if($isCatalogueExist == false){
              $listCatalogue[] = $splitAlt[0];

              $catalogue = new Catalogue();
              $catalogue->setCorpus($corpus);
              $catalogue->setName($splitAlt[0]);

              $manager->persist($catalogue);
              $manager->flush();
            }



            // On vérifie l'existence du dossier
            $isDossierExist = false;
            foreach ($listDossier as $dossier) {
              if( strcmp($dossier, $splitAlt[1]) == 0 ){
                $isDossierExist = true;
              }
            }

            // Si le catalogque n'existe pas, on l'ajoute dans la DB et dans la liste
            if($isDossierExist == false){
              $listDossier[] = $splitAlt[1];

              $catalogue = $manager
                ->getRepository('PHuNPlatformBundle:Catalogue')
                ->findOneBy( array('name' => $splitAlt[0]) );

              $dossier = new Dossier();
              $dossier->setCatalogue($catalogue);
              $dossier->setName($splitAlt[1]);

              $manager->persist($dossier);
              $manager->flush();
            }



            // On vérifie l'existence du dossier
            $isSousDossierExist = false;
            foreach ($listSousDossier as $sousDossier) {
              if( strcmp($sousDossier, $splitAlt[2]) == 0 ){
                $isSousDossierExist = true;
              }
            }

            // Si le catalogque n'existe pas, on l'ajoute dans la DB et dans la liste
            if($isSousDossierExist == false){
              $listSousDossier[] = $splitAlt[2];

              $dossier = $manager->getRepository('PHuNPlatformBundle:Dossier')->findOneByName($splitAlt[1]);

              $sousDossier = new SousDossier();
              $sousDossier->setDossier($dossier);
              $sousDossier->setName($splitAlt[2]);

              $manager->persist($sousDossier);
              $manager->flush();
            }



            // On vérifie l'existence du dossier
            $isPageExist = false;
            foreach ($listPage as $page) {
              if( strcmp($page, $splitAlt[3]) == 0 ){
                $isPageExist = true;
              }
            }

            // Si le catalogque n'existe pas, on l'ajoute dans la DB et dans la liste
            if($isPageExist == false){
              $listPage[] = $splitAlt[3];

              $sousDossier = $manager->getRepository('PHuNPlatformBundle:SousDossier')->findOneByName($splitAlt[2]);

              $page = new Page();
              $page->setSousDossier($sousDossier);

              $path_url_img = $folder_name_img_db . '/' . $alt . '.jpg';
              $path_url_xml = $folder_name_xml_db . '/' . $alt . '.xml';

              $page->setFileName($alt);
              $page->setAlt($splitAlt[3]);
              $page->setUrlImg($path_url_img);
              $page->setUrlXml($path_url_xml);
              $page->setCorpus($corpus);

              $manager->persist($page);
              $manager->flush();
            }
      }
      /**************************
       *
       * FIN DU Traitemenent dans le cas ou length(splitAlt) = 4  => 301-1-1-005 
       *
       **************************/




      /**************************
       *
       * DEBUT DU Traitemenent dans le cas ou length(splitAlt) = 3  => 301-1-005  (catalogue-dossier-page)
       *
       **************************/


      if(count($splitAlt) == 3){
            // On vérifie l'existence du catologue
            $isCatalogueExist = false;
            foreach ($listCatalogue as $catalogue) {
              if( strcmp($catalogue, $splitAlt[0]) == 0 ){
                $isCatalogueExist = true;
              }
            }

            // Si le catalogque n'existe pas, on l'ajoute dans la DB et dans la liste
            if($isCatalogueExist == false){
              $listCatalogue[] = $splitAlt[0];

              $catalogue = new Catalogue();
              $catalogue->setCorpus($corpus);
              $catalogue->setName($splitAlt[0]);

              $manager->persist($catalogue);
              $manager->flush();
            }



            // On vérifie l'existence du dossier
            $isDossierExist = false;
            foreach ($listDossier as $dossier) {
              if( strcmp($dossier, $splitAlt[1]) == 0 ){
                $isDossierExist = true;
              }
            }

            // Si le catalogque n'existe pas, on l'ajoute dans la DB et dans la liste
            if($isDossierExist == false){
              $listDossier[] = $splitAlt[1];

              $catalogue = $manager->getRepository('PHuNPlatformBundle:Catalogue')->findOneByName($splitAlt[0]);

              $dossier = new Dossier();
              $dossier->setCatalogue($catalogue);
              $dossier->setName($splitAlt[1]);

              $manager->persist($dossier);
              $manager->flush();
            }



            // On vérifie l'existence du dossier
            $isSousDossierExist = false;
            $emptySubFolderName = "emptySubFolder";
            foreach ($listSousDossier as $sousDossier) {
              if( strcmp($sousDossier, $emptySubFolderName) == 0 ){
                $isSousDossierExist = true;
              }
            }

            // Si le catalogque n'existe pas, on l'ajoute dans la DB et dans la liste
            if($isSousDossierExist == false){
              $listSousDossier[] = $emptySubFolderName;

              $dossier = $manager->getRepository('PHuNPlatformBundle:Dossier')->findOneByName($splitAlt[1]);

              $sousDossier = new SousDossier();
              $sousDossier->setDossier($dossier);
              $sousDossier->setName($emptySubFolderName);

              $manager->persist($sousDossier);
              $manager->flush();
            }



            // On vérifie l'existence du dossier
            $isPageExist = false;
            foreach ($listPage as $page) {
              if( strcmp($page, $splitAlt[2]) == 0 ){
                $isPageExist = true;
              }
            }

            // Si le catalogque n'existe pas, on l'ajoute dans la DB et dans la liste
            if($isPageExist == false){
              $listPage[] = $splitAlt[2];

              $sousDossier = $manager->getRepository('PHuNPlatformBundle:SousDossier')->findOneByName($emptySubFolderName);

              $page = new Page();
              $page->setSousDossier($sousDossier);

              $path_url_img = $folder_name_img_db . '/' . $alt . '.jpg';
              $path_url_xml = $folder_name_xml_db . '/' . $alt . '.xml';

              $page->setFileName($alt);
              $page->setAlt($splitAlt[2]);
              $page->setUrlImg($path_url_img);
              $page->setUrlXml($path_url_xml);
              $page->setCorpus($corpus);

              $manager->persist($page);
              $manager->flush();
            }
      }

      /**************************
       *
       * FIN DU Traitemenent dans le cas ou length(splitAlt) = 3  => 301-1-005  (catalogue-dossier-page)
       *
       **************************/




      /**************************
       *
       * DEBUT DU Traitemenent dans le cas ou length(splitAlt) = 5  => 31AF19_001_11_07_005  (archive_catalogue_dossier_sousDossier_page)
       *
       **************************/


      if(count($splitAlt) == 5){
            // On vérifie l'existence du catologue
            $isCatalogueExist  = false;
            $url_catalogueName = $splitAlt[0] . '_' . $splitAlt[1];

            foreach ($listCatalogue as $catalogue) {
              if( strcmp($catalogue, $url_catalogueName) == 0 ){
                $isCatalogueExist = true;
              }
            }

            // Si le catalogque n'existe pas, on l'ajoute dans la DB et dans la liste
            if($isCatalogueExist == false){
              $listCatalogue[] = $url_catalogueName;

              $catalogue = new Catalogue();
              $catalogue->setCorpus($corpus);
              $catalogue->setName($url_catalogueName);

              $manager->persist($catalogue);
              $manager->flush();
            }



            // On vérifie l'existence du dossier
            $isDossierExist = false;
            foreach ($listDossier as $dossier) {
              if( strcmp($dossier, $splitAlt[2]) == 0 ){
                $isDossierExist = true;
              }
            }

            // Si le catalogque n'existe pas, on l'ajoute dans la DB et dans la liste
            if($isDossierExist == false){
              $listDossier[] = $splitAlt[2];

              $catalogue = $manager->getRepository('PHuNPlatformBundle:Catalogue')->findOneByName($url_catalogueName);

              $dossier = new Dossier();
              $dossier->setCatalogue($catalogue);
              $dossier->setName($splitAlt[2]);

              $manager->persist($dossier);
              $manager->flush();
            }



            // On vérifie l'existence du dossier
            $isSousDossierExist = false;
            foreach ($listSousDossier as $sousDossier) {
              if( strcmp($sousDossier, $splitAlt[3]) == 0 ){
                $isSousDossierExist = true;
              }
            }

            // Si le catalogque n'existe pas, on l'ajoute dans la DB et dans la liste
            if($isSousDossierExist == false){
              $listSousDossier[] = $splitAlt[3];

              $dossier = $manager->getRepository('PHuNPlatformBundle:Dossier')->findOneByName($splitAlt[2]);

              $sousDossier = new SousDossier();
              $sousDossier->setDossier($dossier);
              $sousDossier->setName($splitAlt[3]);

              $manager->persist($sousDossier);
              $manager->flush();
            }



            // On vérifie l'existence du dossier
            $isPageExist = false;
            foreach ($listPage as $page) {
              if( strcmp($page, $splitAlt[4]) == 0 ){
                $isPageExist = true;
              }
            }

            // Si le catalogque n'existe pas, on l'ajoute dans la DB et dans la liste
            if($isPageExist == false){
              $listPage[] = $splitAlt[4];

              $sousDossier = $manager->getRepository('PHuNPlatformBundle:SousDossier')->findOneByName($splitAlt[3]);

              $page = new Page();
              $page->setSousDossier($sousDossier);

              $path_url_img = $folder_name_img_db . '/' . $alt . '.jpg';
              $path_url_xml = $folder_name_xml_db . '/' . $alt . '.xml';

              $page->setFileName($alt);
              $page->setAlt($splitAlt[4]);
              $page->setUrlImg($path_url_img);
              $page->setUrlXml($path_url_xml);
              $page->setCorpus($corpus);

              $manager->persist($page);
              $manager->flush();
            }
      }

      echo "\n";

      /**************************
       *
       * FIN DU Traitemenent dans le cas ou length(splitAlt) = 5  => 31AF19_001_11_07_005  (archive_catalogue_dossier_sousDossier_page)
       *
       **************************/



      $manager->flush();







      }




/*
    $listRegistre = array();
    $listVolume   = array();
    $listTome     = array();

    foreach ($listPages as $page) {
      $alt = $page->getAlt();
      $splitAlt = preg_split("/(-|_)/", $alt);

      $isRegisterAlreadyHere = false;
      foreach ($listRegistre as $registre) {
        if( strcmp($registre, $splitAlt[0]) == 0 ){
          $isRegisterAlreadyHere = true;
        }
      }
      if($isRegisterAlreadyHere == false)
        $listRegistre[] = $splitAlt[0];

      $isVolumeAlreadyHere = false;
      foreach ($listVolume as $volume) {
        if( strcmp($volume, $splitAlt[1]) == 0 ){
          $isVolumeAlreadyHere = true;
        }
      }
      if($isVolumeAlreadyHere == false)
        $listVolume[] = $splitAlt[1];


      $isTomeAlreadyHere = false;
      foreach ($listTome as $tome) {
        if( strcmp($tome, $splitAlt[2]) == 0 ){
          $isTomeAlreadyHere = true;
        }
      }
      if($isTomeAlreadyHere == false)
        $listTome[] = $splitAlt[2];
    }



    $finalString = "";

    foreach ($listRegistre as $registre)
      $finalString = $finalString . $registre . "|";

    $finalString = $finalString . "%";
    foreach ($listVolume as $volume)
      $finalString = $finalString . $volume . "/";

    $finalString = $finalString . "%";
    foreach ($listTome as $tome)
      $finalString = $finalString . $tome . "+";

    file_put_contents("listPagesCategories", $finalString);
  }
  */

  }
}

