<?php

namespace PHuN\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dossier
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PHuN\PlatformBundle\Entity\DossierRepository")
 */
class Dossier
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
     * @ORM\ManyToOne(targetEntity="PHuN\PlatformBundle\Entity\Catalogue", inversedBy="dossiers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $catalogue;

    /**
     * @ORM\OneToMany(targetEntity="PHuN\PlatformBundle\Entity\Dossier", mappedBy="dossiers")
     */
    private $sousdossier;


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
     * @return Dossier
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
     * Set catalogue
     *
     * @param \PHuN\PlatformBundle\Entity\Catalogue $catalogue
     *
     * @return Dossier
     */
    public function setCatalogue(\PHuN\PlatformBundle\Entity\Catalogue $catalogue)
    {
        $this->catalogue = $catalogue;

        return $this;
    }

    /**
     * Get catalogue
     *
     * @return \PHuN\PlatformBundle\Entity\Catalogue
     */
    public function getCatalogue()
    {
        return $this->catalogue;
    }

    /**
     * Get Dossier
     *
     * @return \PHuN\PlatformBundle\Entity\Dossier
     */
    public function getDossier()
    {
        return $this;
    }
}
