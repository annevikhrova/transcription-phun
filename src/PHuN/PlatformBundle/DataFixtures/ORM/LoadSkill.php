<?php
// src/PHuN/PlatformBundle/DataFixtures/ORM/LoadSkill.php

namespace PHuN\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use PHuN\PlatformBundle\Entity\Skill;

class LoadSkill implements FixtureInterface
{
	public function load(ObjectManager $manager)
	{

	$names = array('PHP', 'Symfony2', 'C++', 'Java', 'Photoshop', 'Blender', 'Bloc-note');

		foreach ($names as $name){
			// on crée la compétence

			$skill = new Skill();
			$skill->setName($name);

			// On la persiste
			$manager->persist($skill);

			// On déclenche l'enregistrement de toutes les catégories
			$manager->flush();
		}
	}
}

