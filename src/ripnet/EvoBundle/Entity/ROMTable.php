<?php

namespace ripnet\EvoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="rom_table")
 */
class ROMTable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="ROM", inversedBy="romTables")
     * @ORM\JoinColumn(name="rom_id", referencedColumnName="id", nullable=FALSE)
     */
    protected $rom;

    /**
     * @ORM\ManyToOne(targetEntity="Table", inversedBy="romTables")
     * @ORM\JoinColumn(name="table_id", referencedColumnName="id", nullable=FALSE)
     */
    protected $table;

    /**
     * @ORM\Column(type="string", length=16)
     */
    protected $address;

    /**
     * @ORM\Column(type="string", length=16, nullable=TRUE)
     */
    protected $xAddress;

    /**
     * @ORM\Column(type="string", length=16, nullable=TRUE)
     */
    protected $yAddress;

    public function __toString()
    {
        return $this->getRom() . " " . $this->getTable();
    }

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
     * Set address
     *
     * @param string $address
     * @return ROMTable
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
     * Set xAddress
     *
     * @param string $xAddress
     * @return ROMTable
     */
    public function setXAddress($xAddress)
    {
        $this->xAddress = $xAddress;

        return $this;
    }

    /**
     * Get xAddress
     *
     * @return string 
     */
    public function getXAddress()
    {
        return $this->xAddress;
    }

    /**
     * Set yAddress
     *
     * @param string $yAddress
     * @return ROMTable
     */
    public function setYAddress($yAddress)
    {
        $this->yAddress = $yAddress;

        return $this;
    }

    /**
     * Get yAddress
     *
     * @return string 
     */
    public function getYAddress()
    {
        return $this->yAddress;
    }

    /**
     * Set rom
     *
     * @param \ripnet\EvoBundle\Entity\ROM $rom
     * @return ROMTable
     */
    public function setRom(\ripnet\EvoBundle\Entity\ROM $rom)
    {
        $this->rom = $rom;

        return $this;
    }

    /**
     * Get rom
     *
     * @return \ripnet\EvoBundle\Entity\ROM 
     */
    public function getRom()
    {
        return $this->rom;
    }

    /**
     * Set table
     *
     * @param \ripnet\EvoBundle\Entity\Table $table
     * @return ROMTable
     */
    public function setTable(\ripnet\EvoBundle\Entity\Table $table)
    {
        $this->table = $table;

        return $this;
    }

    /**
     * Get table
     *
     * @return \ripnet\EvoBundle\Entity\Table 
     */
    public function getTable()
    {
        return $this->table;
    }
}
