<?php

namespace App\Entity;

use App\Repository\MatchsRepository;
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
}