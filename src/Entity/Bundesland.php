<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiProperty;

/**
 * @ORM\Entity
 * @ORM\Table(name="public.bundesland")
 */
class Bundesland
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\Column(name="kuerzel",type="string")
     * @Assert\Length(max=2)
     * @Groups({"adresse:read"})
     */
    private $kuerzel = null;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank
     * @Groups({"adresse:read"})
     */
    public $name;

    /**
     * @ORM\OneToMany(targetEntity="Adresse", mappedBy="bundesland")
     * @var ArrayCollection
     */
    public $adressen;

    /**
     * @return string|null
     * @ApiProperty(identifier=true)
     */
    public function getId(): ?string
    {
        return $this->kuerzel;
    }

    /**
     * @param string $id
     * @return void
     */
    public function setId(string $id): void
    {
        $this->kuerzel = $id;
    }
}