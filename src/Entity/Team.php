<?php

namespace App\Entity;

use App\Entity\Rencontre;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\TeamRepository;
use Doctrine\Common\Collections\Collection;
use JMS\Serializer\Annotation as Serializer;
use Doctrine\Common\Collections\ArrayCollection;

use Hateoas\Configuration\Annotation as Hateoas;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *      "teams.getOne",
 *      parameters = { 
 *      "id" = "expr(object.getId())"
 *    }
 * ),
 *       exclusion = @Hateoas\Exclusion(groups="team")
 * )
*/
#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Serializer\Groups(["team"])]
    private ?int $id = null;

    #[Assert\NotBlank(message: 'Le nom de la team est obligatoire')]
    #[Assert\NotNull()]
    #[Assert\Length(min: 3, minMessage: 'Le nom de la team doit faire au moins {{ limit }} caractères')]
    #[ORM\Column(length: 255)]
    #[Serializer\Groups(["team"])]
    private ?string $teamName = null;

    #[Assert\Choice(choices: ["on", "off"], message: 'Le statut doit être on ou off')]
    #[ORM\Column(length: 255)]
    #[Serializer\Groups(["team"])]
    private ?string $statusTeam = null;

    #[ORM\OneToMany(mappedBy: 'winner', targetEntity: Rencontre::class)]
    #[Serializer\Groups(["team"])]
    private Collection $rencontreWin;

    #[ORM\OneToMany(mappedBy: 'teamA', targetEntity: Rencontre::class)]
    #[Serializer\Groups(["team"])]
    private Collection $rencontreA;

    #[ORM\OneToMany(mappedBy: 'teamB', targetEntity: Rencontre::class)]
    #[Serializer\Groups(["team"])]
    private Collection $rencontreB;
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
    /**
     * @return Collection<int, Rencontre>
     */
    public function getRencontre(): Collection
    {
        foreach ($this->rencontreB as $key => $element) {
            $this->rencontreA->add($element);
        }
        return $this->rencontreA;
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
