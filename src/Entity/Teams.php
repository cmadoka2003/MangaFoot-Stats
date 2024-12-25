<?php

namespace App\Entity;

use App\Repository\TeamsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamsRepository::class)]
class Teams
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'team_id')]
    private ?int $id;

    #[ORM\Column(type: 'string')]
    private ?string $name;

    #[ORM\Column(type: 'string')]
    private ?string $country;

    #[ORM\Column(type: 'string')]
    private ?string $tactics;

    #[ORM\Column(type: 'string')]
    private ?string $logo;

    #[ORM\OneToMany(
        targetEntity: Matchs::class,
        mappedBy: "teamHomeId",
        cascade: ['persist', 'remove']
    )]
    private $teamHome;

    #[ORM\OneToMany(
        targetEntity: Matchs::class,
        mappedBy: "teamAwayId",
        cascade: ['persist', 'remove']
    )]
    private $teamAway;

    #[ORM\OneToMany(
        targetEntity: PlayersTeam::class,
        mappedBy: "teamId",
        cascade: ['persist', 'remove']
    )]
    private $playerTeam;

    #[ORM\OneToMany(
        targetEntity: Favorite::class,
        mappedBy: "teamId",
        cascade: ['persist', 'remove']
    )]
    private $favorite;

    #[ORM\OneToMany(
        targetEntity: Statistics::class,
        mappedBy: "teamId",
        cascade: ['persist', 'remove']
    )]
    private $statistics;

    #[ORM\OneToMany(
        targetEntity: GoalsAssists::class,
        mappedBy: "teamId",
        cascade: ['persist', 'remove']
    )]
    private $goalAssist;

    #[ORM\ManyToOne(targetEntity: Arcs::class, inversedBy: "teams")]
    #[ORM\JoinColumn(name: 'arc_id', referencedColumnName: 'arc_id', nullable: false)]
    private $arcs;  

    public function __construct()
    {
        $this->teamHome = new ArrayCollection();
        $this->teamAway = new ArrayCollection();
        $this->playerTeam = new ArrayCollection();
        $this->favorite = new ArrayCollection();
        $this->statistics = new ArrayCollection();
        $this->goalAssist = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

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

    public function getTactics()
    {
        return $this->tactics;
    }

    public function setTactics($tactics)
    {
        $this->tactics = $tactics;

        return $this;
    }

    public function getLogo()
    {
        return $this->logo;
    }

    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    public function getTeamHome()
    {
        return $this->teamHome;
    }

    public function addTeamHome(Matchs $teamHome)
    {
        $teamHome->setTeamHomeId($this);
        $this->teamHome->add($teamHome);
    }

    public function getTeamAway()
    {
        return $this->teamAway;
    }

    public function addTeamAway(Matchs $teamAway)
    {
        $teamAway->setTeamAwayId($this);
        $this->teamAway->add($teamAway);
    }

    public function getPlayerTeam()
    {
        return $this->playerTeam;
    }

    public function addPlayerTeam(PlayersTeam $playerTeam)
    {
        $playerTeam->setTeamId($this);
        $this->playerTeam->add($playerTeam);
    }

    public function getFavorite()
    {
        return $this->favorite;
    }

    public function addFavorite(Favorite $favorite)
    {
        $favorite->setTeamId($this);
        $this->favorite->add($favorite);
    }

    public function getStatistics()
    {
        return $this->statistics;
    }

    public function addStatistics(Statistics $statistics)
    {
        $statistics->setTeamId($this);
        $this->statistics->add($statistics);
    }

    public function getGoalAssist()
    {
        return $this->goalAssist;
    }

    public function addGoalAssist(GoalsAssists $goalAssist)
    {
        $goalAssist->setTeamId($this);
        $this->goalAssist->add($goalAssist);
    }

    public function getArcs()
    {
        return $this->arcs;
    }

    public function setArcs($arcs)
    {
        $this->arcs = $arcs;

        return $this;
    }
}