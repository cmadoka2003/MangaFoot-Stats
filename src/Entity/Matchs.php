<?php

namespace App\Entity;

use App\Repository\MatchsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatchsRepository::class)]
class Matchs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'match_id')]
    private ?int $id;

    #[ORM\Column(type: 'integer', name: 'team_home_score')]
    private ?int $teamHomeScore;
    
    #[ORM\Column(type: 'integer', name: 'team_away_score')]
    private ?int $teamAwayScore;

    #[ORM\ManyToOne(targetEntity: Arcs::class, inversedBy: "matchs")]
    #[ORM\JoinColumn(name: 'arc_id', referencedColumnName: 'arc_id', nullable: false)]
    private $arcs;  

    #[ORM\ManyToOne(targetEntity: Teams::class, inversedBy: "teamHome")]
    #[ORM\JoinColumn(name: 'team_home_id', referencedColumnName: 'team_id', nullable: false)]
    private $teamHomeId;

    #[ORM\ManyToOne(targetEntity: Teams::class, inversedBy: "teamAway")]
    #[ORM\JoinColumn(name: 'team_away_id', referencedColumnName: 'team_id', nullable: false)]
    private $teamAwayId;

    #[ORM\OneToMany(
        targetEntity: Statistics::class,
        mappedBy: "matchId",
        cascade: ['persist', 'remove']
    )]
    private $statistics;

    #[ORM\OneToMany(
        targetEntity: GoalsAssists::class,
        mappedBy: "matchId",
        cascade: ['persist', 'remove']
    )]
    private $goalAssist;

    public function __construct()
    {
        $this->statistics = new ArrayCollection();
        $this->goalAssist = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTeamHomeScore()
    {
        return $this->teamHomeScore;
    }

    public function setTeamHomeScore($teamHomeScore)
    {
        $this->teamHomeScore = $teamHomeScore;

        return $this;
    }

    public function getTeamAwayScore()
    {
        return $this->teamAwayScore;
    }

    public function setTeamAwayScore($teamAwayScore)
    {
        $this->teamAwayScore = $teamAwayScore;

        return $this;
    }

    public function getArcs()
    {
        return $this->arcs;
    }

    public function setArcs(Arcs $arcs)
    {
        $this->arcs = $arcs;

        return $this;
    }

    public function getTeamHomeId()
    {
        return $this->teamHomeId;
    }

    public function setTeamHomeId(Teams $teamHomeId)
    {
        $this->teamHomeId = $teamHomeId;

        return $this;
    }

    public function getTeamAwayId()
    {
        return $this->teamAwayId;
    }

    public function setTeamAwayId(Teams $teamAwayId)
    {
        $this->teamAwayId = $teamAwayId;

        return $this;
    }

    public function getStatistics()
    {
        return $this->statistics;
    }

    public function addStatistics(Statistics $statistics)
    {
        $statistics->setMatchId($this);
        $this->statistics->add($statistics);
    }
    public function getGoalAssist()
    {
        return $this->goalAssist;
    }

    public function addGoalAssist(GoalsAssists $goalAssist)
    {
        $goalAssist->setMatchId($this);
        $this->goalAssist->add($goalAssist);
    }
}