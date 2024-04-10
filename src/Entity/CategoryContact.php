<?php

namespace App\Entity;

use App\Repository\CategoryContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: CategoryContactRepository::class)]
#[Broadcast]
class CategoryContact
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $name_category_contact = null;

    #[ORM\ManyToOne(inversedBy: 'categoryContacts')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(targetEntity: Person::class, mappedBy: 'category_contact', orphanRemoval: true)]
    private Collection $persons;

    public function __construct()
    {
        $this->persons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCategoryContact(): ?string
    {
        return $this->name_category_contact;
    }

    public function setNameCategoryContact(string $name_category_contact): static
    {
        $this->name_category_contact = $name_category_contact;

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
     * @return Collection<int, Person>
     */
    public function getPersons(): Collection
    {
        return $this->persons;
    }

    public function addPerson(Person $person): static
    {
        if (!$this->persons->contains($person)) {
            $this->persons->add($person);
            $person->setCategoryContact($this);
        }

        return $this;
    }

    public function removePerson(Person $person): static
    {
        if ($this->persons->removeElement($person)) {
            // set the owning side to null (unless already changed)
            if ($person->getCategoryContact() === $this) {
                $person->setCategoryContact(null);
            }
        }

        return $this;
    }
}
