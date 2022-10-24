<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TeamRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["team"])]
    private ?int $id = null;

    #[Assert\NotBlank(message: 'Le nom de la team est obligatoire')]
    #[Assert\NotNull()]
    #[Assert\Length(min: 3, minMessage: 'Le nom de la team doit faire au moins 3 caractères')]
    #[ORM\Column(length: 255)]
    #[Groups(["team"])]
    private ?string $teamName = null;

    #[ORM\Column(length: 255)]
    #[Groups(["team"])]
    private ?string $statusTeam = null;

    #[ORM\OneToMany(mappedBy: 'winner', targetEntity: Rencontre::class)]
    #[Groups(["team"])]
    private Collection $rencontreWin;

    public function __construct()
    {
        $this->rencontreWin = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeamName(): ?string
    {
        return $this->teamName;
    }

    public function setTeamName(string $teamName): self
    {
        $this->teamName = $teamName;

        return $this;
    }

    public function getStatusTeam(): ?string
    {
        return $this->statusTeam;
    }

    public function setStatusTeam(string $statusTeam): self
    {
        $this->statusTeam = $statusTeam;

        return $this;
    }

    /**
     * @return Collection<int, Rencontre>
     */
    public function getRencontreWin(): Collection
    {
        return $this->rencontreWin;
    }

    public function addRencontreWin(Rencontre $rencontreWin): self
    {
        if (!$this->rencontreWin->contains($rencontreWin)) {
            $this->rencontreWin->add($rencontreWin);
            $rencontreWin->setWinner($this);
        }

        return $this;
    }

    public function removeRencontreWin(Rencontre $rencontreWin): self
    {
        if ($this->rencontreWin->removeElement($rencontreWin)) {
            // set the owning side to null (unless already changed)
            if ($rencontreWin->getWinner() === $this) {
                $rencontreWin->setWinner(null);
            }
        }

        return $this;
    }
}
