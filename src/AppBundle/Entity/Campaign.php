<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campaign
 *
 * @ORM\Table(name="campaign")
 * @ORM\Entity
 */
class Campaign
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CampaignId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $campaignid;

    /**
     * @var integer
     *
     * @ORM\Column(name="Year", type="integer", nullable=false)
     */
    private $year;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IsActual", type="boolean", nullable=false)
     */
    private $isactual;



    /**
     * Set year
     *
     * @param integer $year
     *
     * @return Campaign
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set isactual
     *
     * @param boolean $isactual
     *
     * @return Campaign
     */
    public function setIsactual($isactual)
    {
        $this->isactual = $isactual;

        return $this;
    }

    /**
     * Get isactual
     *
     * @return boolean
     */
    public function getIsactual()
    {
        return $this->isactual;
    }

    /**
     * Get campaignid
     *
     * @return integer
     */
    public function getCampaignid()
    {
        return $this->campaignid;
    }
}
