<?php

namespace App\Entity;

use App\Repository\PersonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: PersonRepository::class)]
#[Broadcast]
class Person
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $name_person = null;

    #[ORM\Column(length: 40)]
    private ?string $surname_person = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $last_modified = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Civility $civility = null;

    #[ORM\ManyToOne(inversedBy: 'persons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CategoryContact $category_contact = null;

    #[ORM\ManyToOne(inversedBy: 'persons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(targetEntity: Phone::class, mappedBy: 'person', orphanRemoval: true)]
    private Collection $phones;

    #[ORM\OneToMany(targetEntity: Email::class, mappedBy: 'person', orphanRemoval: true)]
    private Collection $emails;

    public function __construct()
    {
        $this->phones = new ArrayCollection();
        $this->emails = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamePerson(): ?string
    {
        return $this->name_person;
    }

    public function setNamePerson(string $name_person): static
    {
        $this->name_person = $name_person;

        return $this;
    }

    public function getSurnamePerson(): ?string
    {
        return $this->surname_person;
    }

    public function setSurnamePerson(string $surname_person): static
    {
        $this->surname_person = $surname_person;

        return $this;
    }

    public function getCreated(): ?\DateTimeInterface
    {
        return $this->created;
    }

    public function setCreated(\DateTimeInterface $created): static
    {
        $this->created = $created;

        return $this;
    }

    public function getLastModified(): ?\DateTimeInterface
    {
        return $this->last_modified;
    }

    public function setLastModified(\DateTimeInterface $last_modified): static
    {
        $this->last_modified = $last_modified;

        return $this;
    }

    public function getCivility(): ?Civility
    {
        return $this->civility;
    }

    public function setCivility(?Civility $civility): static
    {
        $this->civility = $civility;

        return $this;
    }

    public function getCategoryContact(): ?CategoryContact
    {
        return $this->category_contact;
    }

    public function setCategoryContact(?CategoryContact $category_contact): static
    {
        $this->category_contact = $category_contact;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, Phone>
     */
    public function getPhones(): Collection
    {
        return $this->phones;
    }

    public function addPhone(Phone $phone): static
    {
        if (!$this->phones->contains($phone)) {
            $this->phones->add($phone);
            $phone->setPerson($this);
        }

        return $this;
    }

    public function removePhone(Phone $phone): static
    {
        if ($this->phones->removeElement($phone)) {
            // set the owning side to null (unless already changed)
            if ($phone->getPerson() === $this) {
                $phone->setPerson(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Email>
     */
    public function getEmails(): Collection
    {
        return $this->emails;
    }

    public function addEmail(Email $email): static
    {
        if (!$this->emails->contains($email)) {
            $this->emails->add($email);
            $email->setPerson($this);
        }

        return $this;
    }

    public function removeEmail(Email $email): static
    {
        if ($this->emails->removeElement($email)) {
            // set the owning side to null (unless already changed)
            if ($email->getPerson() === $this) {
                $email->setPerson(null);
            }
        }

        return $this;
    }
}
