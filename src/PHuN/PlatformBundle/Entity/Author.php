<?php

namespace PHuN\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Author
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PHuN\PlatformBundle\Entity\AuthorRepository")
 */
class Author
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
     * @ORM\Column(name="login", type="string", length=255)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;

    /**
      * @ORM\ManyToMany(targetEntity="PHuN\PlatformBundle\Entity\Transcription", cascade={"persist"})
      */
    private $transcription;

     /**
      * @ORM\ManyToMany(targetEntity="PHuN\PlatformBundle\Entity\Project", cascade={"persist"})
      */
    private $project;


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
     * Set login
     *
     * @param string $login
     *
     * @return Author
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Author
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->transcription = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add transcription
     *
     * @param \PHuN\PlatformBundle\Entity\Transcription $transcription
     *
     * @return Author
     */
    public function addTranscription(\PHuN\PlatformBundle\Entity\Transcription $transcription)
    {
        $this->transcription[] = $transcription;

        return $this;
    }

    /**
     * Remove transcription
     *
     * @param \PHuN\PlatformBundle\Entity\Transcription $transcription
     */
    public function removeTranscription(\PHuN\PlatformBundle\Entity\Transcription $transcription)
    {
        $this->transcription->removeElement($transcription);
    }

    /**
     * Get transcription
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTranscription()
    {
        return $this->transcription;
    }

    /**
     * Add project
     *
     * @param \PHuN\PlatformBundle\Entity\Project $project
     *
     * @return Author
     */
    public function addProject(\PHuN\PlatformBundle\Entity\Project $project)
    {
        $this->project[] = $project;

        return $this;
    }

    /**
     * Remove project
     *
     * @param \PHuN\PlatformBundle\Entity\Project $project
     */
    public function removeProject(\PHuN\PlatformBundle\Entity\Project $project)
    {
        $this->project->removeElement($project);
    }

    /**
     * Get project
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProject()
    {
        return $this->project;
    }
}