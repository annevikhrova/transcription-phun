<?php

namespace PHuN\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Page
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PHuN\PlatformBundle\Entity\PageRepository")
 */
class Page
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
     * @ORM\Column(name="url_img", type="string", length=255)
     */
    private $urlImg;

    /**
     * @var string
     *
     * @ORM\Column(name="url_xml", type="string", length=255)
     */
    private $urlXml;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;

    /**
     * @ORM\ManyToOne(targetEntity="PHuN\PlatformBundle\Entity\Corpus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $corpus;


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
     * Set urlImg
     *
     * @param string $urlImg
     *
     * @return Page
     */
    public function setUrlImg($urlImg)
    {
        $this->urlImg = $urlImg;

        return $this;
    }

    /**
     * Get urlImg
     *
     * @return string
     */
    public function getUrlImg()
    {
        return $this->urlImg;
    }

    /**
     * Set urlXml
     *
     * @param string $urlXml
     *
     * @return Page
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
     * Set alt
     *
     * @param string $alt
     *
     * @return Page
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Get alt
     *
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    /**
     * Set corpus
     *
     * @param string $corpus
     *
     * @return Page
     */
    public function setCorpus($corpus)
    {
        $this->corpus = $corpus;

        return $this;
    }

    /**
     * Get corpus
     *
     * @return string
     */
    public function getCorpus()
    {
        return $this->corpus;
    }
}

