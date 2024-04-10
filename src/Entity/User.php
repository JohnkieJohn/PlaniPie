<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\OneToMany(targetEntity: CategoryEvent::class, mappedBy: 'user_id', orphanRemoval: true)]
    private Collection $categoryEvents;

    #[ORM\OneToMany(targetEntity: CategoryContact::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $categoryContacts;

    #[ORM\OneToMany(targetEntity: Person::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $persons;

    #[ORM\OneToMany(targetEntity: UserWeekDay::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $userWeekDays;
    
    #[ORM\OneToMany(targetEntity: Event::class, mappedBy: 'user', orphanRemoval: true)]
    private Collection $events;

    public function __construct()
    {
        $this->categoryEvents = new ArrayCollection();
        $this->categoryContacts = new ArrayCollection();
        $this->persons = new ArrayCollection();
        $this->userWeekDays = new ArrayCollection();
        $this->events = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, CategoryEvent>
     */
    public function getCategoryEvents(): Collection
    {
        return $this->categoryEvents;
    }

    public function addCategoryEvent(CategoryEvent $categoryEvent): static
    {
        if (!$this->categoryEvents->contains($categoryEvent)) {
            $this->categoryEvents->add($categoryEvent);
            $categoryEvent->setUserId($this);
        }

        return $this;
    }

    public function removeCategoryEvent(CategoryEvent $categoryEvent): static
    {
        if ($this->categoryEvents->removeElement($categoryEvent)) {
            // set the owning side to null (unless already changed)
            if ($categoryEvent->getUserId() === $this) {
                $categoryEvent->setUserId(null);
            }
        }

        return $this;
    }

    
    /** 
    *@return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): static
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
            $event->setUser($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): static
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getUser() === $this) {
                $event->setUser(null);
            }
        }

        return $this;
    }

  /**
     * @return Collection<int, CategoryContact>
     */
    public function getCategoryContacts(): Collection
    {
        return $this->categoryContacts;
    }

    public function addCategoryContact(CategoryContact $categoryContact): static
    {
        if (!$this->categoryContacts->contains($categoryContact)) {
            $this->categoryContacts->add($categoryContact);
            $categoryContact->setUser($this);
        }

        return $this;
    }
    public function removeCategoryContact(CategoryContact $categoryContact): static
    {
        if ($this->categoryContacts->removeElement($categoryContact)) {
            // set the owning side to null (unless already changed)
            if ($categoryContact->getUser() === $this) {
                $categoryContact->setUser(null);
            }
        }

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
            $person->setUser($this);
        }

        return $this;
    }

    public function removePerson(Person $person): static
    {
        if ($this->persons->removeElement($person)) {
            // set the owning side to null (unless already changed)
            if ($person->getUser() === $this) {
                $person->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UserWeekDay>
     */
    public function getUserWeekDays(): Collection
    {
        return $this->userWeekDays;
    }

    public function addUserWeekDay(UserWeekDay $userWeekDay): static
    {
        if (!$this->userWeekDays->contains($userWeekDay)) {
            $this->userWeekDays->add($userWeekDay);
            $userWeekDay->setUser($this);
        }

        return $this;
    }

    public function removeUserWeekDay(UserWeekDay $userWeekDay): static
    {
        if ($this->userWeekDays->removeElement($userWeekDay)) {
            // set the owning side to null (unless already changed)
            if ($userWeekDay->getUser() === $this) {
                $userWeekDay->setUser(null);
            }
        }
        return $this;
    }

}
