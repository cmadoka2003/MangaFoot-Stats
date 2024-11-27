<?php

namespace App\Entity;

use App\Repository\FavoriteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FavoriteRepository::class)]
class Favorite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'favorite_id')]
    private ?int $id;

    #[ORM\ManyToOne(targetEntity: Player::class, inversedBy: "favorite")]
    #[ORM\JoinColumn(name: 'player_id', referencedColumnName: 'player_id')]
    private $playerId;

    #[ORM\ManyToOne(targetEntity: Teams::class, inversedBy: "favorite")]
    #[ORM\JoinColumn(name: 'team_id', referencedColumnName: 'team_id')]
    private $teamId;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "favorite")]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'user_id', nullable: false)]
    private $userId;

    public function getId()
    {
        return $this->id;
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

    public function getTeamId()
    {
        return $this->teamId;
    }

    public function setTeamId(Teams $teamId)
    {
        $this->teamId = $teamId;

        return $this;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId(User $userId)
    {
        $this->userId = $userId;

        return $this;
    }
}