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
     * @ORM\OneToMany(targetEntity="PHuN\PlatformBundle\Entity\Catalogue", mappedBy="corpus")
     */
    private $catalogue;

    /**
     * @ORM\OneToOne(targetEntity="PHuN\PlatformBundle\Entity\Stylesheet", cascade={"persist"})
     */
    private $stylesheet;

    /**
     * @ORM\OneToOne(targetEntity="PHuN\PlatformBundle\Entity\Dtd", cascade={"persist"})
     */
    private $dtd;

    /**
     * @ORM\ManyToMany(targetEntity="PHuN\UserBundle\Entity\User", mappedBy="corpora")
     */
    private $users;



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

    /**
     * Add catalogue
     *
     * @param \PHuN\PlatformBundle\Entity\Catalogue $catalogue
     *
     * @return Corpus
     */
    public function addCatalogue(\PHuN\PlatformBundle\Entity\Catalogue $catalogue)
    {
        $this->catalogue[] = $catalogue;

        return $this;
    }

    /**
     * Remove catalogue
     *
     * @param \PHuN\PlatformBundle\Entity\Catalogue $catalogue
     */
    public function removeCatalogue(\PHuN\PlatformBundle\Entity\Catalogue $catalogue)
    {
        $this->catalogue->removeElement($catalogue);
    }

    /**
     * Get catalogue
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCatalogue()
    {
        return $this->catalogue;
    }

    /**
     * Get corpus
     *
     * @return Corpus
     */
    public function getCorpus()
    {
        return $this;
    }

    /**
     * Set stylesheet
     *
     * @param \PHuN\PlatformBundle\Entity\Stylesheet $stylesheet
     *
     * @return Corpus
     */
    public function setStylesheet(\PHuN\PlatformBundle\Entity\Stylesheet $stylesheet = null)
    {
        $this->stylesheet = $stylesheet;

        return $this;
    }

    /**
     * Get stylesheet
     *
     * @return \PHuN\PlatformBundle\Entity\Stylesheet
     */
    public function getStylesheet()
    {
        return $this->stylesheet;
    }

    /**
     * Set dtd
     *
     * @param \PHuN\PlatformBundle\Entity\Dtd $dtd
     *
     * @return Corpus
     */
    public function setDtd(\PHuN\PlatformBundle\Entity\Dtd $dtd = null)
    {
        $this->dtd = $dtd;

        return $this;
    }

    /**
     * Get dtd
     *
     * @return \PHuN\PlatformBundle\Entity\Dtd
     */
    public function getDtd()
    {
        return $this->dtd;
    }

    /**
     * Add user
     *
     * @param \PHuN\UserBundle\Entity\User $user
     *
     * @return Corpus
     */
    public function addUser(\PHuN\UserBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \PHuN\UserBundle\Entity\User $user
     */
    public function removeUser(\PHuN\UserBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
}
