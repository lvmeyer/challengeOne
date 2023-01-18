<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ModerationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModerationRepository::class)]
#[ApiResource]
class Moderation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'moderations')]
    private ?User $user_id = null;

    #[ORM\OneToOne(inversedBy: 'moderation', cascade: ['persist', 'remove'])]
    private ?Comment $commentaire_id = null;

    #[ORM\Column(nullable: true)]
    private ?int $counterUserBan = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?User
    {
        return $this->user_id;
    }

    public function setUserId(?User $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getCommentaireId(): ?Comment
    {
        return $this->commentaire_id;
    }

    public function setCommentaireId(?Comment $commentaire_id): self
    {
        $this->commentaire_id = $commentaire_id;

        return $this;
    }

    public function getCounterUserBan(): ?int
    {
        return $this->counterUserBan;
    }

    public function setCounterUserBan(?int $counterUserBan): self
    {
        $this->counterUserBan = $counterUserBan;

        return $this;
    }
}
