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
    //$listNames = array('ScoobyDoo', 'Snoopy', 'Pluto');
      $listUsers = $manager->getRepository('PHuNUserBundle:User')
                          ->findAll();

    foreach ($listUsers as $user) {
      // On crée l'utilisateur
      //$user = new User();
      $location = 72;  
      $role = $user->getRoles();
      // Le nom d'utilisateur et le mot de passe sont identiques
      $user->setLocation($location);
      $user->setRoles($role);
      

      // On le persiste
      $manager->persist($user);
    }

    // On déclenche l'enregistrement
    $manager->flush();
  }
}

