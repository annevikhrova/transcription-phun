<?php

namespace PHuN\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Stylesheet
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PHuN\PlatformBundle\Entity\StylesheetRepository")
 */
class Stylesheet
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
     * @ORM\Column(name="filename", type="string", length=255)
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255)
     */
    private $url;



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
     * Set filename
     *
     * @param string $filename
     *
     * @return Stylesheet
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Stylesheet
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set corpus
     *
     * @param \PHuN\PlatformBundle\Entity\Corpus $corpus
     *
     * @return Stylesheet
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

    public function upload()
  {
    // Si jamais il n'y a pas de fichier (champ facultatif), on ne fait rien
    if (null === $this->filename) {
      return;
    }

    // On récupère le nom original du fichier de l'internaute
    $name = $this->filename->getClientOriginalName();

    // On déplace le fichier envoyé dans le répertoire de notre choix
    $this->filename->move($this->getUploadRootDir(), $name);

    // On sauvegarde le nom de fichier dans notre attribut $url
    $this->url = $this->getUploadDir() . '/' . $name;

    // On crée également le futur attribut alt de notre balise <img>
     $this->filename = $name;
  }

  public function getUploadDir()
  {
    // On retourne le chemin relatif vers l'image pour un navigateur (relatif au répertoire /web donc) avec le nom original du fichier de l'internaute
    return 'corpus/css/'.$this->getId();
  }

  protected function getUploadRootDir()
  {
    // On retourne le chemin relatif vers l'image pour notre code PHP
    return __DIR__.'/../../../../web/'.$this->getUploadDir();
  }
}
