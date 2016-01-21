<?php

namespace PHuN\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Corpus
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PHuN\PlatformBundle\Entity\CorpusRepository")
 */
class Corpus
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
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="plugin_list", type="text")
     */
    private $pluginList;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime")
     */
    private $startDate;

    /**
     * @ORM\OneToOne(targetEntity="PHuN\PlatformBundle\Entity\Image", cascade={"persist"})
     */
    private $image;


    /**
     * @ORM\ManyToMany(targetEntity="PHuN\PlatformBundle\Entity\Plugin", cascade={"persist"})
     */
    private $plugins;

    /**
     * @ORM\ManyToMany(targetEntity="PHuN\PlatformBundle\Entity\Plugin", cascade={"persist"})
     * @ORM\JoinTable(name="corpus_menu1")
     */
    private $pluginsMenu1;

    /**
     * @ORM\ManyToOne(targetEntity="PHuN\PlatformBundle\Entity\Category", cascade={"persist"})
    */
    public $category;


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
     * Set categoryId
     *
     * @param integer $categoryId
     *
     * @return Corpus
     */
    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;

        return $this;
    }

    /**
     * Get categoryId
     *
     * @return integer
     */
    public function getCategoryId()
    {
        return $this->categoryId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Corpus
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
     * Set description
     *
     * @param string $description
     *
     * @return Corpus
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

    /**
     * Set pluginList
     *
     * @param string $pluginList
     *
     * @return Corpus
     */
    public function setPluginList($pluginList)
    {
        $this->pluginList = $pluginList;

        return $this;
    }

    /**
     * Get pluginList
     *
     * @return string
     */
    public function getPluginList()
    {
        return $this->pluginList;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Corpus
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }


    /**
     * Set image
     *
     * @param \PHuN\PlatformBundle\Entity\Image $image
     *
     * @return Corpus
     */
    public function setImage(\PHuN\PlatformBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \PHuN\PlatformBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set category
     *
     * @param \PHuN\PlatformBundle\Entity\Category $category
     *
     * @return Corpus
     */
    public function setCategory(\PHuN\PlatformBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \PHuN\PlatformBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->plugins = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add plugin
     *
     * @param \PHuN\PlatformBundle\Entity\Plugin $plugin
     *
     * @return Corpus
     */
    public function addPlugin(\PHuN\PlatformBundle\Entity\Plugin $plugin)
    {
        $this->plugins[] = $plugin;

        return $this;
    }

    /**
     * Remove plugin
     *
     * @param \PHuN\PlatformBundle\Entity\Plugin $plugin
     */
    public function removePlugin(\PHuN\PlatformBundle\Entity\Plugin $plugin)
    {
        $this->plugins->removeElement($plugin);
    }

    /**
     * Get plugins
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlugins()
    {
        return $this->plugins;
    }

    /**
     * Add pluginsMenu1
     *
     * @param \PHuN\PlatformBundle\Entity\Plugin $pluginsMenu1
     *
     * @return Corpus
     */
    public function addPluginsMenu1(\PHuN\PlatformBundle\Entity\Plugin $pluginsMenu1)
    {
        $this->pluginsMenu1[] = $pluginsMenu1;

        return $this;
    }

    /**
     * Remove pluginsMenu1
     *
     * @param \PHuN\PlatformBundle\Entity\Plugin $pluginsMenu1
     */
    public function removePluginsMenu1(\PHuN\PlatformBundle\Entity\Plugin $pluginsMenu1)
    {
        $this->pluginsMenu1->removeElement($pluginsMenu1);
    }

    /**
     * Get pluginsMenu1
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPluginsMenu1()
    {
        return $this->pluginsMenu1;
    }
}
