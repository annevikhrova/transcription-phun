<?php

namespace PHuN\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Score
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="PHuN\PlatformBundle\Entity\ScoreRepository")
 */
class Score
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
     * @var integer
     *
     * @ORM\Column(name="score_at_the_time", type="bigint")
     */
    private $scoreAtTheTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_of_ranking", type="datetime")
     */
    private $dateOfRanking;


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
     * Set scoreAtTheTime
     *
     * @param integer $scoreAtTheTime
     *
     * @return Score
     */
    public function setScoreAtTheTime($scoreAtTheTime)
    {
        $this->scoreAtTheTime = $scoreAtTheTime;

        return $this;
    }

    /**
     * Get scoreAtTheTime
     *
     * @return integer
     */
    public function getScoreAtTheTime()
    {
        return $this->scoreAtTheTime;
    }

    /**
     * Set dateOfRanking
     *
     * @param \DateTime $dateOfRanking
     *
     * @return Score
     */
    public function setDateOfRanking($dateOfRanking)
    {
        $this->dateOfRanking = $dateOfRanking;

        return $this;
    }

    /**
     * Get dateOfRanking
     *
     * @return \DateTime
     */
    public function getDateOfRanking()
    {
        return $this->dateOfRanking;
    }
}

