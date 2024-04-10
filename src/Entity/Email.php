<?php

namespace App\Entity;

use App\Repository\EmailRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: EmailRepository::class)]
#[Broadcast]
class Email
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 254)]
    private ?string $address_email = null;

    #[ORM\Column]
    private ?bool $type_pro_mail = null;

    #[ORM\ManyToOne(inversedBy: 'emails')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Person $person = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddressEmail(): ?string
    {
        return $this->address_email;
    }

    public function setAddressEmail(string $address_email): static
    {
        $this->address_email = $address_email;

        return $this;
    }

    public function isTypeProMail(): ?bool
    {
        return $this->type_pro_mail;
    }

    public function setTypeProMail(bool $type_pro_mail): static
    {
        $this->type_pro_mail = $type_pro_mail;

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
