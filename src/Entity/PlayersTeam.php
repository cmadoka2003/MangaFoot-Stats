<?php

namespace App\Entity;

use App\Repository\PlayersTeamRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayersTeamRepository::class)]
class PlayersTeam
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'players_team_id')]
    private ?int $id;

    #[ORM\Column(type: 'string', name: 'player_position')]
    private ?string $playerPosition;

    #[ORM\Column(type: 'boolean')]
    private ?bool $actif;

    #[ORM\ManyToOne(targetEntity: Teams::class, inversedBy: "playerTeam")]
    #[ORM\JoinColumn(name: 'team_id', referencedColumnName: 'team_id', nullable: false)]
    private $teamId;

    #[ORM\ManyToOne(targetEntity: Player::class, inversedBy: "playerTeam")]
    #[ORM\JoinColumn(name: 'player_id', referencedColumnName: 'player_id', nullable: false)]
    private $playerId;

    public function getId()
    {
        return $this->id;
    }

    public function getPlayerPosition()
    {
        return $this->playerPosition;
    }

    public function setPlayerPosition($playerPosition)
    {
        $this->playerPosition = $playerPosition;

        return $this;
    }

    public function getActif()
    {
        return $this->actif;
    }

    public function setActif($actif)
    {
        $this->actif = $actif;

        return $this;
    }

    public function getTeamId()
    {
        return $this->teamId;
    }

    public function setTeamId(Teams $teamId)
    {
        $this->teamId = $teamId;

        return $this;
    }

    public function getPlayerId()
    {
        return $this->playerId;
    }

    public function setPlayerId(Player $playerId)
    {
        $this->playerId = $playerId;

        return $this;
    }
}