<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: EventRepository::class)]
#[Broadcast]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $title_event = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $desc_event = null;

    #[ORM\Column]
    private ?bool $recurrence_event = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $recurrence_end_event = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $last_modified = null;

    #[ORM\ManyToOne]
    private ?TimeUnit $time_unit = null;

    #[ORM\ManyToOne]
    private ?Symbol $symbol = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CategoryEvent $category_event = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\OneToMany(targetEntity: DetailEvent::class, mappedBy: 'event', orphanRemoval: true)]
    private Collection $detailEvents;

    public function __construct()
    {
        $this->detailEvents = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleEvent(): ?string
    {
        return $this->title_event;
    }

    public function setTitleEvent(string $title_event): static
    {
        $this->title_event = $title_event;

        return $this;
    }

    public function getDescEvent(): ?string
    {
        return $this->desc_event;
    }

    public function setDescEvent(?string $desc_event): static
    {
        $this->desc_event = $desc_event;

        return $this;
    }

    public function isRecurrenceEvent(): ?bool
    {
        return $this->recurrence_event;
    }

    public function setRecurrenceEvent(bool $recurrence_event): static
    {
        $this->recurrence_event = $recurrence_event;

        return $this;
    }

    public function getRecurrenceEndEvent(): ?\DateTimeInterface
    {
        return $this->recurrence_end_event;
    }

    public function setRecurrenceEndEvent(\DateTimeInterface $recurrence_end_event): static
    {
        $this->recurrence_end_event = $recurrence_end_event;

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

    public function getTimeUnit(): ?TimeUnit
    {
        return $this->time_unit;
    }

    public function setTimeUnit(?TimeUnit $time_unit): static
    {
        $this->time_unit = $time_unit;

        return $this;
    }

    public function getSymbol(): ?Symbol
    {
        return $this->symbol;
    }

    public function setSymbol(?Symbol $symbol): static
    {
        $this->symbol = $symbol;

        return $this;
    }

    public function getCategoryEvent(): ?CategoryEvent
    {
        return $this->category_event;
    }

    public function setCategoryEvent(?CategoryEvent $category_event): static
    {
        $this->category_event = $category_event;

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
     * @return Collection<int, DetailEvent>
     */
    public function getDetailEvents(): Collection
    {
        return $this->detailEvents;
    }

    public function addDetailEvent(DetailEvent $detailEvent): static
    {
        if (!$this->detailEvents->contains($detailEvent)) {
            $this->detailEvents->add($detailEvent);
            $detailEvent->setEvent($this);
        }

        return $this;
    }

    public function removeDetailEvent(DetailEvent $detailEvent): static
    {
        if ($this->detailEvents->removeElement($detailEvent)) {
            // set the owning side to null (unless already changed)
            if ($detailEvent->getEvent() === $this) {
                $detailEvent->setEvent(null);
            }
        }

        return $this;
    }
}
