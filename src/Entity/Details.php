<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Entity
 * @ORM\Table(name="std.kunde_adresse")
 */
class Details
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(name="kunde_id", type="string", length=36)
     */
    public $kundeId;

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(name="adresse_id", type="integer")
     */
    public $adresseId;

    /**
     * @var bool
     * @ORM\Column(name="geschaeftlich", type="boolean")
     * @Groups({"adresse:read"})
     */
    public $geschaeftlich;

    /**
     * @var bool
     * @ORM\Column(name="rechnungsadresse", type="boolean")
     * @Groups({"adresse:read"})
     */
    public $rechnungsadresse;

    /**
     * @var bool
     * @ORM\Column(name="geloescht", type="boolean")
     * @Groups({"adresse:read"})
     */
    public $geloescht;

    /**
     * @var ArrayCollection|Adresse[]
     * @ORM\ManyToOne(targetEntity="Adresse", inversedBy="details")
     * @ORM\JoinColumn(name="adresse_id", referencedColumnName="adresse_id")
     * @Groups({"adresse:read"})
     * @MaxDepth(1)
     */
    private $adressen;

    /**
     * @return ArrayCollection|Adresse[]
     */
    public function getAdressen()
    {
        return $this->adressen;
    }

    /**
     * @param ArrayCollection $adressen
     * @return void
     */
    public function setAdressen(ArrayCollection $adressen) : void
    {
        $this->adressen = $adressen;
    }
}