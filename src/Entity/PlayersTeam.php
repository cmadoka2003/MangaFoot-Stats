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
    private ?string $actif;

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
}