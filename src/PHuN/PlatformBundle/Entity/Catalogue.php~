<?php

namespace PHuN\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Catalogue
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PHuN\PlatformBundle\Entity\CatalogueRepository")
 */
class Catalogue
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="PHuN\PlatformBundle\Entity\Corpus", inversedBy="catalogue")
     * @ORM\JoinColumn(nullable=false)
     */
    private $corpus;

    /**
     * @ORM\OneToMany(targetEntity="PHuN\PlatformBundle\Entity\Dossier", mappedBy="catalogue")
     */
    private $dossier;

    /**
     * Get catalogue
     *
     * @return Catalogue
     */
    public function getCatalogue()
    {
        return $this;
    }



    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Catalogue
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set corpus
     *
     * @param \PHuN\PlatformBundle\Entity\Corpus $corpus
     *
     * @return Catalogue
     */
    public function setCorpus(\PHuN\PlatformBundle\Entity\Corpus $corpus)
    {
        $this->corpus = $corpus;

        return $this;
    }

    /**
     * Get corpus
     *
     * @return \PHuN\PlatformBundle\Entity\Corpus
     */
    public function getCorpus()
    {
        return $this->corpus;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dossier = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add dossier
     *
     * @param \PHuN\PlatformBundle\Entity\Dossier $dossier
     *
     * @return Catalogue
     */
    public function addDossier(\PHuN\PlatformBundle\Entity\Dossier $dossier)
    {
        $this->dossier[] = $dossier;

        return $this;
    }

    /**
     * Remove dossier
     *
     * @param \PHuN\PlatformBundle\Entity\Dossier $dossier
     */
    public function removeDossier(\PHuN\PlatformBundle\Entity\Dossier $dossier)
    {
        $this->dossier->removeElement($dossier);
    }

    /**
     * Get dossiers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDossier()
    {
        return $this->dossier;
    }
}
