<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\DBAL\Exception\InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\Mapping\ClassMetadata;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="std.tbl_kunden")
 * @ApiResource(
 *     normalizationContext={"groups"={"kunde"}, "enable_max_depth"=true},
 *     collectionOperations={
 *         "get"={"path"="/kunden"},
 *         "post"={"path"="/kunden"}
 *     },
 *     itemOperations={
 *         "get"={"path"="/kunden/{id}"},
 *         "put"={"path"="/kunden/{id}"},
 *         "patch"={"path"="/kunden/{id}"},
 *         "delete"={"path"="/kunden/{id}"},
 *     }
 * )
 */
class Kunde
{
    /**
     * Der eindeutige Identifier.
     * @var string
     * @ORM\Id
     * @ORM\Column(name="id", type="string", columnDefinition="upper(left(gen_random_uuid()::text, 8))", options={"comment"="Column Comment Here"})
     * @Assert\Length(max=36)
     * @Groups({"kunde","vermittler"})
     */
    private $id = null;

    /**
     * Der Familienname des Kunden.
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(max=255)
     * @Groups({"kunde","vermittler"})
     */
    public $name = '';

    /**
     * Der Vorname des Kunden.
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     * @Assert\Length(max=255)
     * @Groups({"kunde","vermittler"})
     */
    public $vorname = '';

    /**
     * Der Name der Firma, bei der der Kunde arbeitet.
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max=255)
     * @Groups({"kunde","vermittler"})
     */
    public $firma = '';

    /**
     * Das Geburtsdatum, im Format 'yyyy-mm-dd'.
     * @ORM\Column(type="datetime")
     * @Assert\NotBlank
     * @Assert\Type("\DateTimeInterface")
     * @Groups({"kunde","vermittler"})
     */
    public $geburtsdatum = '';

    /**
     * Markiert einen Kunden als gelöscht.
     * @ORM\Column(type="integer")
     * @Groups({"kunde","vermittler"})
     */
    public $geloescht = false;

    /**
     * Das Geschlecht des Kunden.
     * @ORM\Column(type="string")
     * @Groups({"kunde","vermittler"})
     */
    public $geschlecht = '';

    /**
     * Die E-Mail-Adresse, die der Kunde nutzt.
     * @ORM\Column(type="string")
     * @Assert\Email
     * @Groups({"kunde","vermittler"})
     */
    public $email = '';

    /**
     * @ORM\ManyToOne(targetEntity="Vermittler", inversedBy="kunden")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"kunde"})
     */
    private $vermittler;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }


    public function getVermittler()
    {
        return $this->vermittler;
    }

    public function setVermittler($vermittler)
    {
        if (!is_a($vermittler, 'App\Entity\Vermittler')) {
            throw new InvalidArgumentException('Es muss ein Vermittler übergeben werden.');
        }

        $this->vermittler = $vermittler;
    }
}