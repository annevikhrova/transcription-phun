<?php
// src/PHuN/UserBundle/DataFixtures/ORM/LoadCorpus.php

namespace PHuN\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PHuN\PlatformBundle\Entity\Corpus;


class LoadCorpus implements FixtureInterface
{
  public function load(ObjectManager $manager)
  {
    // Les noms d'utilisateurs à créer
    $listNames = array('Stendhal', 'Groult', 'Proust', 'Toussaint');

    foreach ($listNames as $name) {
      // On crée l'utilisateur
      $corpus = new Corpus();

      // Le nom d'utilisateur et le mot de passe sont identiques
      $corpus->setName($name);
      $corpus->setTypeId(1);
      $corpus->setDescription("Les pages numérisées des manuscrits de et leurs transcriptions.");

      $corpus->setPluginList('');
      $corpus->setStartDate(new \Datetime());

      // On le persiste
      $manager->persist($corpus);
    }

    // On déclenche l'enregistrement
    $manager->flush();
  }
}
