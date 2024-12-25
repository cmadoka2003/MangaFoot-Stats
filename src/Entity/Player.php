<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
class Player
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'player_id')]
    private ?int $id;

    #[ORM\Column(type: 'string')]
    private ?string $avatar;

    #[ORM\Column(type: 'string')]
    private ?string $firstname;

    #[ORM\Column(type: 'string')]
    private ?string $lastname;

    #[ORM\Column(type: 'integer')]
    private ?int $age;

    #[ORM\Column(type: 'string')]
    private ?string $birthdate;

    #[ORM\Column(type: 'string')]
    private ?string $height;

    #[ORM\Column(type: 'string')]
    private ?string $positionFavorite;

    #[ORM\Column(type: 'string')]
    private ?string $country;

    #[ORM\Column(type: 'integer')]
    private ?int $number;

    #[ORM\OneToMany(
        targetEntity: PlayersTeam::class,
        mappedBy: "playerId",
        cascade: ['persist', 'remove']
    )]
    private $playerTeam;

    #[ORM\OneToMany(
        targetEntity: Overalls::class,
        mappedBy: "playerId",
        cascade: ['persist', 'remove']
    )]
    private $overall;

    #[ORM\OneToMany(
        targetEntity: Favorite::class,
        mappedBy: "playerId",
        cascade: ['persist', 'remove']
    )]
    private $favorite;

    #[ORM\OneToMany(
        targetEntity: Statistics::class,
        mappedBy: "playerId",
        cascade: ['persist', 'remove']
    )]
    private $statistics;

    #[ORM\OneToMany(
        targetEntity: GoalsAssists::class,
        mappedBy: "goalId",
        cascade: ['persist', 'remove']
    )]
    private $goal;

    #[ORM\OneToMany(
        targetEntity: GoalsAssists::class,
        mappedBy: "assistId",
        cascade: ['persist', 'remove']
    )]
    private $assist;

    public function __construct()
    {
        $this->playerTeam = new ArrayCollection();
        $this->overall = new ArrayCollection();
        $this->favorite = new ArrayCollection();
        $this->statistics = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    public function getPositionFavorite()
    {
        return $this->positionFavorite;
    }

    public function setPositionFavorite($positionFavorite)
    {
        $this->positionFavorite = $positionFavorite;

        return $this;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getPlayerTeam()
    {
        return $this->playerTeam;
    }

    public function addPlayerTeam(PlayersTeam $playerTeam)
    {
        $playerTeam->setPlayerId($this);
        $this->playerTeam->add($playerTeam);
    }

    public function getOverall()
    {
        return $this->overall;
    }

    public function addOverall(Overalls $overall)
    {
        $overall->setPlayerId($this);
        $this->overall->add($overall);
    }

    public function getFavorite()
    {
        return $this->favorite;
    }

    public function addFavorite(Favorite $favorite)
    {
        $favorite->setPlayerId($this);
        $this->favorite->add($favorite);
    }

    public function getStatistics()
    {
        return $this->statistics;
    }

    public function addStatistics(Statistics $statistics)
    {
        $statistics->setPlayerId($this);
        $this->statistics->add($statistics);
    }

    public function getGoal()
    {
        return $this->goal;
    }

    public function addGoal(GoalsAssists $goal)
    {
        $goal->setGoalId($this);
        $this->goal->add($goal);
    }

    public function getAssist()
    {
        return $this->assist;
    }

    public function addAssist(GoalsAssists $assist)
    {
        $assist->setAssistId($this);
        $this->assist->add($assist);
    }
}