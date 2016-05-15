<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \Doctrine\Common\Collections\ArrayCollection;

/**
 * Lot
 *
 * @ORM\Table(name="lot", indexes={@ORM\Index(name="establishment_fk", columns={"EstablishmentId"})})
 * @ORM\Entity
 */
class Lot
{
    /**
     * @var integer
     *
     * @ORM\Column(name="LotId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $lotid;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Address", type="string", length=50, nullable=false)
     */
    private $address;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IsActive", type="boolean", nullable=false)
     */
    private $isactive;

    /**
     * @var \Establishment
     *
     * @ORM\ManyToOne(targetEntity="Establishment", inversedBy="lots")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="EstablishmentId", referencedColumnName="EstablishmentId")
     * })
     */
    private $establishmentid;

    /**
     * @ORM\OneToMany(targetEntity="Sector", mappedBy="lotid")
     */
    private $sectors;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sectors = new ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Lot
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Lot
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set isactive
     *
     * @param boolean $isactive
     *
     * @return Lot
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
     * Get lotid
     *
     * @return integer
     */
    public function getLotid()
    {
        return $this->lotid;
    }

    /**
     * Set establishmentid
     *
     * @param \AppBundle\Entity\Establishment $establishmentid
     *
     * @return Lot
     */
    public function setEstablishmentid(\AppBundle\Entity\Establishment $establishmentid = null)
    {
        $this->establishmentid = $establishmentid;

        return $this;
    }

    /**
     * Get establishmentid
     *
     * @return \AppBundle\Entity\Establishment
     */
    public function getEstablishmentid()
    {
        return $this->establishmentid;
    }

    /**
     * Add sector
     *
     * @param \AppBundle\Entity\Sector $sector
     *
     * @return Lot
     */
    public function addSector(\AppBundle\Entity\Sector $sector)
    {
        $this->sectors[] = $sector;

        return $this;
    }

    /**
     * Remove sector
     *
     * @param \AppBundle\Entity\Sector $sector
     */
    public function removeSector(\AppBundle\Entity\Sector $sector)
    {
        $this->sectors->removeElement($sector);
    }

    /**
     * Get sectors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSectors()
    {
        return $this->sectors;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
