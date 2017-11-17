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
     * @ORM\Column(name="thumb", type="string", length=255)
     */
    private $thumb;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255)
     */
    private $alt;

    /**
     * @var string
     *
     * @ORM\Column(name="file_name", type="string", length=255)
     */
    private $fileName;

    /**
     * @ORM\ManyToOne(targetEntity="PHuN\PlatformBundle\Entity\Corpus")
     * @ORM\JoinColumn(nullable=false)
     */
    private $corpus;

    /**
     * @ORM\ManyToOne(targetEntity="PHuN\PlatformBundle\Entity\SousDossier")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sousdossier;

    /**
     * @var \boolean
     *
     * @ORM\Column(name="published", type="boolean")
     */
    private $published = false;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_published_transcription", type="integer")
     */
    private $id_published_transcription;



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

    /**
     * Set sousdossier
     *
     * @param \PHuN\PlatformBundle\Entity\SousDossier $sousdossier
     *
     * @return Page
     */
    public function setSousdossier(\PHuN\PlatformBundle\Entity\SousDossier $sousdossier)
    {
        $this->sousdossier = $sousdossier;

        return $this;
    }

    /**
     * Get sousdossier
     *
     * @return \PHuN\PlatformBundle\Entity\SousDossier
     */
    public function getSousdossier()
    {
        return $this->sousdossier;
    }

    /**
     * Set fileName
     *
     * @param string $fileName
     *
     * @return Page
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get fileName
     *
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set thumb
     *
     * @param string $thumb
     *
     * @return Page
     */
    public function setThumb($thumb)
    {
        $this->thumb = $thumb;

        return $this;
    }

    /**
     * Get thumb
     *
     * @return string
     */
    public function getThumb()
    {
        return $this->thumb;
    }

    /**
     * Set published
     *
     * @param boolean $published
     *
     * @return Page
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
     * Set idPublishedTranscription
     *
     * @param integer $idPublishedTranscription
     *
     * @return Page
     */
    public function setIdPublishedTranscription($idPublishedTranscription)
    {
        $this->id_published_transcription = $idPublishedTranscription;

        return $this;
    }

    /**
     * Get idPublishedTranscription
     *
     * @return integer
     */
    public function getIdPublishedTranscription()
    {
        return $this->id_published_transcription;
    }


}
