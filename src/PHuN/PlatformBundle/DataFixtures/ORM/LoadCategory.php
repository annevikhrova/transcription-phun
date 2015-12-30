<?php
// src/PHuN/PlatformBundle/DataFixtures/ORM/LoadCategory.php


namespace PHuN\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PHuN\PlatformBundle\Entity\Category;

class LoadCategory implements FixtureInterface
{
	//
	public function load(ObjectManager $manager)
	{
	//
	$names = array(
		'Développement web',
		'Développement mobile',
		'Graphisme',
		'Intégration',
		'Réseau'
	);

		foreach($names as $name){
			//on crée la catégorie
			$category = new Category();
			$category->setName($name);

			//on la persiste
			$manager->persist($category);
		}

		//On déclenche l'enregistrement de toute les catégories
		$manager->flush();
	}
}