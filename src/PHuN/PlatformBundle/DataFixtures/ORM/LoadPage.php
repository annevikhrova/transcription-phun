<?php
// src/PHuN/UserBundle/DataFixtures/ORM/LoadPage.php

namespace PHuN\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PHuN\PlatformBundle\Entity\Page;
use Symfony\Component\Finder\Finder;


class LoadPage implements FixtureInterface
{
  public function load(ObjectManager $manager)
  {

    // Noom du folder ou sont les images
    $folder_name_images = '/Applications/MAMP/htdocs/PHuN/phun/image_catalogue/images';
    $fn_img_length = strlen($folder_name_images);

    // Noom du folder ou sont les xml
    $folder_name_xml = '/Applications/MAMP/htdocs/PHuN/phun/cataloque_xml/xml';
    $folder_name_images_bd = '../../../../../../../PHuN/phun/image_catalogue/images';
    $folder_name_xml_bd = '../../../../../../../PHuN/phun/catalogue_xml/xml';
    // Les noms d'utilisateurs à créer
    $finder =new Finder();
    $listUrl = $finder->name('*.jpg')->in($folder_name_images);

    $corpus = $manager->getRepository('PHuNPlatformBundle:Corpus')->find(1);

    // $corpus = new Corpus();
    // $corpus->setName("Stendhal - new");


    foreach ($listUrl as $url) {
      // On crée l'utilisateur
      $page = new Page();

      // Découpage de l'url
      $path_url = $url;    // '/Applications/MAMP/htdocs/PHuN/phun/image_catalogue/images/425_5456.jpg'

      $relative_name = substr($path_url, $fn_img_length+1);
      $relative_name = substr($relative_name, 0, -4);

      $path_url_xml = $folder_name_xml_bd . '/' . $relative_name . '.xml';
      
      $path_url_jpg = $folder_name_images_bd . '/' . $relative_name . '.jpg';

      $page->setUrlImg($path_url_jpg);

      $page->setUrlXml($path_url_xml );

      $page->setCorpus($corpus);

      $page->setAlt($relative_name);
    

      // On le persiste
      $manager->persist($page);
    }

    // On déclenche l'enregistrement
    $manager->flush();
  }
}

