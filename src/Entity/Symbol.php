<?php

namespace App\Entity;

use App\Repository\SymbolRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SymbolRepository::class)]
class Symbol
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 60)]
    private ?string $value_symbol = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValueSymbol(): ?string
    {
        return $this->value_symbol;
    }

    public function setValueSymbol(string $value_symbol): static
    {
        $this->value_symbol = $value_symbol;

        return $this;
    }
}
