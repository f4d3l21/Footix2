<?php

namespace App\Entity;

use App\Repository\RencontreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RencontreRepository::class)]
class Rencontre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $teamA = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Team $teamB = null;

    #[ORM\ManyToOne(inversedBy: 'rencontreWin')]
    private ?Team $winner = null;

    #[ORM\Column]
    private ?int $scoreA = null;

    #[ORM\Column]
    private ?int $scoreB = null;

    #[ORM\Column(length: 20)]
    private ?string $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getTeamA(): ?Team
    {
        return $this->teamA;
    }

    public function setTeamA(?Team $teamA): self
    {
        $this->teamA = $teamA;

        return $this;
    }

    public function getTeamB(): ?Team
    {
        return $this->teamB;
    }

    public function setTeamB(?Team $teamB): self
    {
        $this->teamB = $teamB;

        return $this;
    }

    public function getWinner(): ?Team
    {
        return $this->winner;
    }

    public function setWinner(?Team $winner): self
    {
        $this->winner = $winner;

        return $this;
    }

    public function getScoreA(): ?int
    {
        return $this->scoreA;
    }

    public function setScoreA(int $scoreA): self
    {
        $this->scoreA = $scoreA;

        return $this;
    }

    public function getScoreB(): ?int
    {
        return $this->scoreB;
    }

    public function setScoreB(int $scoreB): self
    {
        $this->scoreB = $scoreB;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
