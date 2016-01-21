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
     * @ORM\Column(name="published", type="boolean")
     */
    private $published = true;

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
}
