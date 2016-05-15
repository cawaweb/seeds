<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Sector
 *
 * @ORM\Table(name="sector", indexes={@ORM\Index(name="lot_fk", columns={"LotId"})})
 * @ORM\Entity
 */
class Sector
{
    /**
     * @var integer
     *
     * @ORM\Column(name="SectorId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $sectorid;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=50, nullable=false)
     */
    private $description;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IsActive", type="boolean", nullable=false)
     */
    private $isactive;

    /**
     * @var \Lot
     *
     * @ORM\ManyToOne(targetEntity="Lot", inversedBy="sectors")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="LotId", referencedColumnName="LotId")
     * })
     */
    private $lotid;

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Sector
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set isactive
     *
     * @param boolean $isactive
     *
     * @return Sector
     */
    public function setIsactive($isactive)
    {
        $this->isactive = $isactive;

        return $this;
    }

    /**
     * Get isactive
     *
     * @return boolean
     */
    public function getIsactive()
    {
        return $this->isactive;
    }

    /**
     * Get sectorid
     *
     * @return integer
     */
    public function getSectorid()
    {
        return $this->sectorid;
    }

    /**
     * Set lotid
     *
     * @param \AppBundle\Entity\Lot $lotid
     *
     * @return Sector
     */
    public function setLotid(\AppBundle\Entity\Lot $lotid = null)
    {
        $this->lotid = $lotid;

        return $this;
    }

    /**
     * Get lotid
     *
     * @return \AppBundle\Entity\Lot
     */
    public function getLotid()
    {
        return $this->lotid;
    }

    public function __toString()
    {
        return $this->getDescription();
    }
}
