<?php

namespace PHuN\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Plugin
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PHuN\PlatformBundle\Entity\PluginRepository")
 */
class Plugin
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
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=500, nullable=true)
     */
    private $description;
    

    /**
     *
     * @ORM\ManyToMany(targetEntity="PHuN\PlatformBundle\Entity\Container", cascade={"persist"})
     */
    private $containers;
    
 

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
     * @return Plugin
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
     * Get plugins
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlugins()
    {
        return $this->name;
    }

 
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->containers = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add container
     *
     * @param \PHuN\PlatformBundle\Entity\Container $container
     *
     * @return Plugin
     */
    public function addContainer(\PHuN\PlatformBundle\Entity\Container $container)
    {
        $this->containers[] = $container;

        return $this;
    }

    /**
     * Remove container
     *
     * @param \PHuN\PlatformBundle\Entity\Container $container
     */
    public function removeContainer(\PHuN\PlatformBundle\Entity\Container $container)
    {
        $this->containers->removeElement($container);
    }

    /**
     * Get containers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContainers()
    {
        return $this->containers;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Plugin
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
