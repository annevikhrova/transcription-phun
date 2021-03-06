<?php

namespace PHuN\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Comment
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PHuN\PlatformBundle\Entity\CommentRepository")
 */
class Comment
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
     * @ORM\Column(name="text", type="string", length=1000)
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime")
     */
    private $datetime;

    /**
     * @ORM\ManyToOne(targetEntity="PHuN\UserBundle\Entity\User", cascade={"persist"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="PHuN\PlatformBundle\Entity\Page")
     * @ORM\JoinColumn(nullable=false)
     */
    private $page;


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
     * Set text
     *
     * @param string $text
     *
     * @return Comment
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set datetime
     *
     * @param \DateTime $datetime
     *
     * @return Comment
     */
    public function setDatetime($datetime)
    {
        $this->datetime = $datetime;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime
     */
    public function getDatetime()
    {
        return $this->datetime;
    }

    /**
     * Set user
     *
     * @param \PHuN\UserBundle\Entity\User $user
     *
     * @return Comment
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
     * Set page
     *
     * @param \PHuN\PlatformBundle\Entity\Page $page
     *
     * @return Comment
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
}
