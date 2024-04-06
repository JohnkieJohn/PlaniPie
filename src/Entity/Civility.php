<?php

namespace App\Entity;

use App\Repository\CivilityRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CivilityRepository::class)]
class Civility
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 9)]
    private ?string $name_civility = null;

    #[ORM\Column(length: 3)]
    private ?string $abbr_civility = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdCivility(): ?int
    {
        return $this->id_civility;
    }

    public function setIdCivility(int $id_civility): static
    {
        $this->id_civility = $id_civility;

        return $this;
    }

    public function getNameCivility(): ?string
    {
        return $this->name_civility;
    }

    public function setNameCivility(string $name_civility): static
    {
        $this->name_civility = $name_civility;

        return $this;
    }

    public function getAbbrCivility(): ?string
    {
        return $this->abbr_civility;
    }

    public function setAbbrCivility(string $abbr_civility): static
    {
        $this->abbr_civility = $abbr_civility;

        return $this;
    }
}
