<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiProperty;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="std.adresse")
 * @ApiResource(
 *     normalizationContext={"groups"={"adresse:read"}, "enable_max_depth"=true},
 *     denormalizationContext={"groups"={"adresse:write"}, "enable_max_depth"=true},
 *     collectionOperations={
 *         "get"={"path"="/adressen"},
 *         "post"={"path"="/adressen"}
 *     },
 *     itemOperations={
 *         "get"={"path"="/adressen/{id}"},
 *         "put"={"path"="/adressen/{id}"},
 *         "patch"={"path"="/adressen/{id}"},
 *         "delete"={"path"="/adressen/{id}"},
 *     }
 * )
 */
class Adresse
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(name="adresse_id", type="integer")
     * @Groups({"adresse:read", "kunde:read"})
     */
    private $adresse_id = null;

    /**
     * @ORM\Column(type="string")
     * @Groups({"adresse:read", "kunde:read"})
     */
    public $strasse;

    /**
     * @ORM\Column(type="string")
     * @Assert\Length(max=10)
     * @Groups({"adresse:read", "kunde:read"})
     */
    public $plz;

    /**
     * @ORM\Column(type="string")
     * @Groups({"adresse:read", "kunde:read"})
     */
    public $ort;

    /**
     * @var string
     * @ORM\Column(type="string", length=2)
     * @Groups({"adresse:read", "kunde:read"})
     */
    public $bundesland;

    /**
     * @return string|null
     * @ApiProperty(identifier=true)
     */
    public function getId() : ?string
    {
        return $this->adresse_id;
    }
}
