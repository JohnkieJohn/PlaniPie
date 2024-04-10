<?php

namespace App\Entity;

use App\Repository\DetailEventRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: DetailEventRepository::class)]
#[Broadcast]
class DetailEvent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $start_datetime_detail_event = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $end_datetime_detail_event = null;

    #[ORM\Column(length: 254)]
    private ?string $location_detail_event = null;

    #[ORM\Column]
    private ?bool $bool_mail_detail_event = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $delay_mail_detail_event = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $all_day_event = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $last_modified = null;

    #[ORM\ManyToOne(inversedBy: 'detailEvents')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Event $event = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDatetimeDetailEvent(): ?\DateTimeInterface
    {
        return $this->start_datetime_detail_event;
    }

    public function setStartDatetimeDetailEvent(\DateTimeInterface $start_datetime_detail_event): static
    {
        $this->start_datetime_detail_event = $start_datetime_detail_event;

        return $this;
    }

    public function getEndDatetimeDetailEvent(): ?\DateTimeInterface
    {
        return $this->end_datetime_detail_event;
    }

    public function setEndDatetimeDetailEvent(\DateTimeInterface $end_datetime_detail_event): static
    {
        $this->end_datetime_detail_event = $end_datetime_detail_event;

        return $this;
    }

    public function getLocationDetailEvent(): ?string
    {
        return $this->location_detail_event;
    }

    public function setLocationDetailEvent(string $location_detail_event): static
    {
        $this->location_detail_event = $location_detail_event;

        return $this;
    }

    public function isBoolMailDetailEvent(): ?bool
    {
        return $this->bool_mail_detail_event;
    }

    public function setBoolMailDetailEvent(bool $bool_mail_detail_event): static
    {
        $this->bool_mail_detail_event = $bool_mail_detail_event;

        return $this;
    }

    public function getDelayMailDetailEvent(): ?int
    {
        return $this->delay_mail_detail_event;
    }

    public function setDelayMailDetailEvent(?int $delay_mail_detail_event): static
    {
        $this->delay_mail_detail_event = $delay_mail_detail_event;

        return $this;
    }

    public function getAllDayEvent(): ?\DateTimeInterface
    {
        return $this->all_day_event;
    }

    public function setAllDayEvent(\DateTimeInterface $all_day_event): static
    {
        $this->all_day_event = $all_day_event;

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

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): static
    {
        $this->event = $event;

        return $this;
    }
}
