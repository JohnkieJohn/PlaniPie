<?php

namespace App\Entity;

use App\Repository\ColorRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ColorRepository::class)]
class Color
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $value_color = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValueColor(): ?string
    {
        return $this->value_color;
    }

    public function setValueColor(string $value_color): static
    {
        $this->value_color = $value_color;

        return $this;
    }
}
