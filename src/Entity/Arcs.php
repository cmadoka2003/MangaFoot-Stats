<?php

namespace App\Entity;

use App\Repository\ArcsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArcsRepository::class)]
class Arcs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer', name: 'arc_id')]
    private ?int $id;

    #[ORM\Column(type: 'string')]
    private ?string $name;

    #[ORM\OneToMany(
        targetEntity: Matchs::class,
        mappedBy: "arcs",
        cascade: ['persist', 'remove']
    )]
    private $matchs;

    #[ORM\OneToMany(
        targetEntity: Teams::class,
        mappedBy: "arcs",
        cascade: ['persist', 'remove']
    )]
    private $teams;

    #[ORM\OneToMany(
        targetEntity: GoalsAssists::class,
        mappedBy: "arcs",
        cascade: ['persist', 'remove']
    )]
    private $goalsAssists;

    #[ORM\OneToMany(
        targetEntity: Statistics::class,
        mappedBy: "arcs",
        cascade: ['persist', 'remove']
    )]
    private $statistics;

    public function __construct()
    {
        $this->matchs = new ArrayCollection();
        $this->teams = new ArrayCollection();
        $this->goalsAssists = new ArrayCollection();
        $this->statistics = new ArrayCollection();
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

    public function getMatchs()
    {
        return $this->matchs;
    }

    public function addMatchs(Matchs $matchs)
    {
        $matchs->setArcs($this);
        $this->matchs->add($matchs);
    }

    public function getTeams()
    {
        return $this->teams;
    }

    public function addTeams(Teams $teams)
    {
        $teams->setArcs($this);
        $this->teams->add($teams);
    }

    public function getGoalsAssists()
    {
        return $this->goalsAssists;
    }

    public function addGoalsAssists(GoalsAssists $goalsAssists)
    {
        $goalsAssists->setArcs($this);
        $this->goalsAssists->add($goalsAssists);
    }

    public function getStatistics()
    {
        return $this->statistics;
    }

    public function addStatistics(Statistics $statistics)
    {
        $statistics->setArcs($this);
        $this->statistics->add($statistics);
    }
}
