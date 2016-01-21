<?php
// src/PHuN/UserBundle/DataFixtures/ORM/LoadUser.php

namespace PHuN\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PHuN\UserBundle\Entity\User;


class LoadUser implements FixtureInterface
{
  public function load(ObjectManager $manager)
  {
    // Les noms d'utilisateurs à créer
    $listNames = array('ScoobyDoo', 'Snoopy', 'Pluto');

    foreach ($listNames as $name) {
      // On crée l'utilisateur
      $user = new User();

      // Le nom d'utilisateur et le mot de passe sont identiques
      $user->setUsername($name);
      $user->setPassword($name);
      $user->setEmail($name.'@gmail.com');
      // On ne se sert pas du sel pour l'instant
      //$user->setSalt('');
      // On définit uniquement le role ROLE_USER qui est le role de base
      $user->addRole('ROLE_AUTEUR');

      // On le persiste
      $manager->persist($user);
    }

    // On déclenche l'enregistrement
    $manager->flush();
  }
}

