<?php

namespace App\Entity;

use App\Repository\OverallRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OverallRepository::class)]
class Overalls
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'overall_id')]
    private ?int $id;

    #[ORM\Column(type: 'integer')]
    private ?int $total;

    #[ORM\Column(type: 'integer')]
    private ?int $speed;

    #[ORM\Column(type: 'integer')]
    private ?int $offense;

    #[ORM\Column(type: 'integer')]
    private ?int $shoot;

    #[ORM\Column(type: 'integer')]
    private ?int $dribble;

    #[ORM\Column(type: 'integer')]
    private ?int $pass;

    #[ORM\Column(type: 'integer')]
    private ?int $defend;
    

    #[ORM\ManyToOne(targetEntity: Player::class, inversedBy: "overall")]
    #[ORM\JoinColumn(name: 'player_id', referencedColumnName: 'player_id', nullable: false)]
    private $playerId;

    public function getId()
    {
        return $this->id;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    public function getSpeed()
    {
        return $this->speed;
    }

    public function setSpeed($speed)
    {
        $this->speed = $speed;

        return $this;
    }

    public function getOffense()
    {
        return $this->offense;
    }

    public function setOffense($offense)
    {
        $this->offense = $offense;

        return $this;
    }

    public function getShoot()
    {
        return $this->shoot;
    }

    public function setShoot($shoot)
    {
        $this->shoot = $shoot;

        return $this;
    }

    public function getDribble()
    {
        return $this->dribble;
    }

    public function setDribble($dribble)
    {
        $this->dribble = $dribble;

        return $this;
    }

    public function getPass()
    {
        return $this->pass;
    }

    public function setPass($pass)
    {
        $this->pass = $pass;

        return $this;
    }

    public function getDefend()
    {
        return $this->defend;
    }

    public function setDefend($defend)
    {
        $this->defend = $defend;

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