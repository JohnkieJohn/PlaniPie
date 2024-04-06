<?php

namespace App\Entity;

use App\Repository\MonthRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MonthRepository::class)]
class Month
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 9)]
    private ?string $name_month = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameMonth(): ?string
    {
        return $this->name_month;
    }

    public function setNameMonth(string $name_month): static
    {
        $this->name_month = $name_month;

        return $this;
    }
}
