<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \Doctrine\Common\Collections\ArrayCollection;

/**
 * Establishment
 *
 * @ORM\Table(name="establishment")
 * @ORM\Entity
 */
class Establishment
{
    /**
     * @var integer
     *
     * @ORM\Column(name="EstablishmentId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $establishmentid;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=50, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Country", type="string", length=50, nullable=false)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="City", type="string", length=50, nullable=false)
     */
    private $city;

    /**
     * @var boolean
     *
     * @ORM\Column(name="IsActive", type="boolean", nullable=false)
     */
    private $isactive;

    /**
     * @ORM\OneToMany(targetEntity="Lot", mappedBy="establishmentid")
     */
    private $lots;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lots = new ArrayCollection();
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Establishment
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
     * Set country
     *
     * @param string $country
     *
     * @return Establishment
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Establishment
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set isactive
     *
     * @param boolean $isactive
     *
     * @return Establishment
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
     * Get establishmentid
     *
     * @return integer
     */
    public function getEstablishmentid()
    {
        return $this->establishmentid;
    }

    /**
     * Add lot
     *
     * @param \AppBundle\Entity\Lot $lot
     *
     * @return Establishment
     */
    public function addLot(\AppBundle\Entity\Lot $lot)
    {
        $this->lots[] = $lot;

        return $this;
    }

    /**
     * Remove lot
     *
     * @param \AppBundle\Entity\Lot $lot
     */
    public function removeLot(\AppBundle\Entity\Lot $lot)
    {
        $this->lots->removeElement($lot);
    }

    /**
     * Get lots
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLots()
    {
        return $this->lots;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
