<?php

namespace PHuN\PlatformBundle\Entity;

/**
 * CatalogueRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CatalogueRepository extends \Doctrine\ORM\EntityRepository
{

	public function getSelectedCorpusQueryBuilder($idCorpus)
	{
	    return $this
    	 	->createQueryBuilder('catalogue')
      		->where('catalogue.corpus = :corpus')
      		->setParameter('corpus', $idCorpus)
	    ;
	}
}