<?php

namespace App\Entity;

use App\Repository\WeekDayRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WeekDayRepository::class)]
class WeekDay
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 8)]
    private ?string $name_week_day = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameWeekDay(): ?string
    {
        return $this->name_week_day;
    }

    public function setNameWeekDay(string $name_week_day): static
    {
        $this->name_week_day = $name_week_day;

        return $this;
    }
}
