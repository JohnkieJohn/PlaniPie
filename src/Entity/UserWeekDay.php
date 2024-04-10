<?php

namespace App\Entity;

use App\Repository\UserWeekDayRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\UX\Turbo\Attribute\Broadcast;

#[ORM\Entity(repositoryClass: UserWeekDayRepository::class)]
#[Broadcast]
class UserWeekDay
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $start_hour_user_weekday = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $end_hour_user_weekday = null;

    #[ORM\ManyToOne(inversedBy: 'userWeekDays')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?WeekDay $week_day = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartHourUserWeekday(): ?\DateTimeInterface
    {
        return $this->start_hour_user_weekday;
    }

    public function setStartHourUserWeekday(\DateTimeInterface $start_hour_user_weekday): static
    {
        $this->start_hour_user_weekday = $start_hour_user_weekday;

        return $this;
    }

    public function getEndHourUserWeekday(): ?\DateTimeInterface
    {
        return $this->end_hour_user_weekday;
    }

    public function setEndHourUserWeekday(\DateTimeInterface $end_hour_user_weekday): static
    {
        $this->end_hour_user_weekday = $end_hour_user_weekday;

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

    public function getWeekDay(): ?WeekDay
    {
        return $this->week_day;
    }

    public function setWeekDay(?WeekDay $week_day): static
    {
        $this->week_day = $week_day;

        return $this;
    }
}
