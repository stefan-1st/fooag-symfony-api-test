<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ApiResource(
 *     normalizationContext={"groups"={"vermittler"}, "enable_max_depth"=true},
 *     collectionOperations={
 *         "get"={"path"="/vermittler"},
 *         "post"={"path"="/vermittler"}
 *     },
 *     itemOperations={
 *         "get"={"path"="/vermittler/{id}"},
 *         "put"={"path"="/vermittler/{id}"},
 *         "patch"={"path"="/vermittler/{id}"},
 *         "delete"={"path"="/vermittler/{id}"},
 *     }
 * )
 * @ORM\Table(name="std.vermittler")
 */
class Vermittler
{
    /**
     * Der eindeutige Identifier.
     * @var string
     * @ORM\Id
     * @ORM\Column(type="string")
     * @ORM\GeneratedValue
     * @Groups({"vermittler", "kunde:read"})
     */
    private $id = null;

    /**
     * Eine Nummer.
     * @ORM\Column(type="string", length=36)
     * @Assert\NotBlank
     * @Assert\Length(max=36)
     * @Groups({"vermittler", "kunde:read"})
     */
    public $nummer = '';

    /**
     * Der Vorname des Vermittlers.
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(max=255)
     * @Groups({"vermittler", "kunde:read"})
     */
    public $vorname = '';

    /**
     * Der Familienname des Kunden.
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(max=255)
     * @Groups({"vermittler", "kunde:read"})
     */
    public $nachname = '';

    /**
     * Der Firmenname der Firma, für die der Vermittler arbeitet.
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(max=255)
     * @Groups({"vermittler", "kunde:read"})
     */
    public $firma = '';

    /**
     * Markiert einen Vermittler als gelöscht.
     * @ORM\Column(type="boolean")
     * @Groups({"vermittler", "kunde:read"})
     */
    public $geloescht = false;

    /**
     * @ORM\OneToMany(targetEntity="Kunde", mappedBy="vermittler")
     * @Groups({"vermittler"})
     */
    public $kunden;

    public function __construct()
    {
        $this->kunden = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }
}