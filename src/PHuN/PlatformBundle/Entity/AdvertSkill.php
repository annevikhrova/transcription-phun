<?php

namespace PHuN\PlatformBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * AdvertSkill
 *
 * @ORM\Entity(repositoryClass="PHuN\PlatformBundle\Entity\AdvertSkillRepository")
 */
class AdvertSkill
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
     * @ORM\Column(name="level", type="string", length=255)
     */
    private $level;

    /**
     * @ORM\ManyToOne(targetEntity="PHuN\PlatformBundle\Entity\Advert")
     * @ORM\JoinColumn(nullable=false)
     */
    private $advert;

    /**
     * @ORM\ManyToOne(targetEntity="PHuN\PlatformBundle\Entity\Skill")
     * @ORM\JoinColumn(nullable=false)
     */
    private $skill;


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
     * Set level
     *
     * @param string $level
     *
     * @return AdvertSkill
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return string
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set advert
     *
     * @param string $advert
     *
     * @return AdvertSkill
     */
    public function setAdvert($advert)
    {
        $this->advert = $advert;

        return $this;
    }

    /**
     * Get advert
     *
     * @return string
     */
    public function getAdvert()
    {
        return $this->advert;
    }

    /**
     * Set skill
     *
     * @param string $skill
     *
     * @return AdvertSkill
     */
    public function setSkill($skill)
    {
        $this->skill = $skill;

        return $this;
    }

    /**
     * Get skill
     *
     * @return string
     */
    public function getSkill()
    {
        return $this->skill;
    }
}
