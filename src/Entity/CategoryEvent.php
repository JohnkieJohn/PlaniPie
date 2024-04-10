<?php
namespace App\Entity;

use App\Repository\CategoryEventRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryEventRepository::class)]
class CategoryEvent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $name_category_event = null;

    #[ORM\ManyToOne(inversedBy: 'categoryEvents')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCategoryEvent(): ?string
    {
        return $this->name_category_event;
    }

    public function setNameCategoryEvent(string $name_category_event): static
    {
        $this->name_category_event = $name_category_event;

        return $this;
    }

    public function getUserId(): ?User
    {
        return $this->user;
    }

    public function setUserId(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
