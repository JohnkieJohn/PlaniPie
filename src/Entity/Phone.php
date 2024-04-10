<?php

namespace App\Entity;

use App\Repository\PhoneRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PhoneRepository::class)]
class Phone
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $number_phone = null;

    #[ORM\Column]
    private ?bool $type_pro_phone = null;

    #[ORM\ManyToOne(inversedBy: 'phones')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Person $person = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberPhone(): ?string
    {
        return $this->number_phone;
    }

    public function setNumberPhone(string $number_phone): static
    {
        $this->number_phone = $number_phone;

        return $this;
    }

    public function isTypeProPhone(): ?bool
    {
        return $this->type_pro_phone;
    }

    public function setTypeProPhone(bool $type_pro_phone): static
    {
        $this->type_pro_phone = $type_pro_phone;

        return $this;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): static
    {
        $this->person = $person;

        return $this;
    }
}
