<?php

namespace PHuN\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transcription
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PHuN\PlatformBundle\Entity\TranscriptionRepository")
 */
class Transcription
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
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="PHuN\PlatformBundle\Entity\Page")
     * @ORM\JoinColumn(nullable=false)
     */
    private $page;

    /**
     * @ORM\ManyToOne(targetEntity="PHuN\UserBundle\Entity\User", cascade={"persist"})
     */
    private $user;

    /**
     * @var \boolean
     *
     * @ORM\Column(name="revision", type="boolean")
     */
    private $revision = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="nb_revisions", type="integer")
     */
    private $nb_revisions;
    
    /**
     * @ORM\ManyToOne(targetEntity="PHuN\UserBundle\Entity\User", cascade={"persist"})
     */
    private $user_revision_1;

    /**
     * @ORM\ManyToOne(targetEntity="PHuN\UserBundle\Entity\User", cascade={"persist"})
     */
    private $user_revision_2; 
    
    /**
     * @ORM\ManyToOne(targetEntity="PHuN\UserBundle\Entity\User", cascade={"persist"})
     */
    private $user_revision_3;
    
    /**
     * @var \boolean
     *
     * @ORM\Column(name="published", type="boolean")
     */
    private $published = false;

    /**
     * @var string
     *
     * @ORM\Column(name="url_xml", type="string", length=255)
     */
    private $urlXml;


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
     * Set content
     *
     * @param string $content
     *
     * @return Transcription
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Transcription
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set published
     *
     * @param boolean $published
     *
     * @return Transcription
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set page
     *
     * @param \PHuN\PlatformBundle\Entity\Page $page
     *
     * @return Transcription
     */
    public function setPage(\PHuN\PlatformBundle\Entity\Page $page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return \PHuN\PlatformBundle\Entity\Page
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set user
     *
     * @param \PHuN\UserBundle\Entity\User $user
     *
     * @return Transcription
     */
    public function setUser(\PHuN\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \PHuN\UserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set urlXml
     *
     * @param string $urlXml
     *
     * @return Transcription
     */
    public function setUrlXml($urlXml)
    {
        $this->urlXml = $urlXml;

        return $this;
    }

    /**
     * Get urlXml
     *
     * @return string
     */
    public function getUrlXml()
    {
        return $this->urlXml;
    }

    /**
     * Set revision
     *
     * @param boolean $revision
     *
     * @return Transcription
     */
    public function setRevision($revision)
    {
        $this->revision = $revision;

        return $this;
    }

    /**
     * Get revision
     *
     * @return boolean
     */
    public function getRevision()
    {
        return $this->revision;
    }

    /**
     * Set nbRevisions
     *
     * @param integer $nbRevisions
     *
     * @return Transcription
     */
    public function setNbRevisions($nbRevisions)
    {
        $this->nb_revisions = $nbRevisions;

        return $this;
    }

    /**
     * Get nbRevisions
     *
     * @return integer
     */
    public function getNbRevisions()
    {
        return $this->nb_revisions;
    }


    /**
     * Set userRevision1
     *
     * @param \PHuN\UserBundle\Entity\User $userRevision1
     *
     * @return Transcription
     */
    public function setUserRevision1(\PHuN\UserBundle\Entity\User $userRevision1 = null)
    {
        $this->user_revision_1 = $userRevision1;

        return $this;
    }

    /**
     * Get userRevision1
     *
     * @return \PHuN\UserBundle\Entity\User
     */
    public function getUserRevision1()
    {
        return $this->user_revision_1;
    }

    /**
     * Set userRevision2
     *
     * @param \PHuN\UserBundle\Entity\User $userRevision2
     *
     * @return Transcription
     */
    public function setUserRevision2(\PHuN\UserBundle\Entity\User $userRevision2 = null)
    {
        $this->user_revision_2 = $userRevision2;

        return $this;
    }

    /**
     * Get userRevision2
     *
     * @return \PHuN\UserBundle\Entity\User
     */
    public function getUserRevision2()
    {
        return $this->user_revision_2;
    }

    /**
     * Set userRevision3
     *
     * @param \PHuN\UserBundle\Entity\User $userRevision3
     *
     * @return Transcription
     */
    public function setUserRevision3(\PHuN\UserBundle\Entity\User $userRevision3 = null)
    {
        $this->user_revision_3 = $userRevision3;

        return $this;
    }

    /**
     * Get userRevision3
     *
     * @return \PHuN\UserBundle\Entity\User
     */
    public function getUserRevision3()
    {
        return $this->user_revision_3;
    }
}
