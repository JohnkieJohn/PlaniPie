<?php

namespace App\Entity;

use App\Repository\TimeUnitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TimeUnitRepository::class)]
class TimeUnit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 15)]
    private ?string $name_time_unit = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameTimeUnit(): ?string
    {
        return $this->name_time_unit;
    }

    public function setNameTimeUnit(string $name_time_unit): static
    {
        $this->name_time_unit = $name_time_unit;

        return $this;
    }
}
