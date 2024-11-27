<?php

namespace App\Entity;

use App\Repository\GoalsAssistsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GoalsAssistsRepository::class)]
class GoalsAssists
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'goal_assist_id')]
    private ?int $id;

    #[ORM\ManyToOne(targetEntity: Matchs::class, inversedBy: "goalAssist")]
    #[ORM\JoinColumn(name: 'match_id', referencedColumnName: 'match_id', nullable: false)]
    private $matchId;

    #[ORM\ManyToOne(targetEntity: Teams::class, inversedBy: "goalAssist")]
    #[ORM\JoinColumn(name: 'team_id', referencedColumnName: 'team_id', nullable: false)]
    private $teamId;

    #[ORM\ManyToOne(targetEntity: Player::class, inversedBy: "goal")]
    #[ORM\JoinColumn(name: 'goal_id', referencedColumnName: 'player_id', nullable: false)]
    private $goalId;

    #[ORM\ManyToOne(targetEntity: Player::class, inversedBy: "assist")]
    #[ORM\JoinColumn(name: 'assist_id', referencedColumnName: 'player_id')]
    private $assistId;


    public function getId()
    {
        return $this->id;
    }

    public function getMatchId()
    {
        return $this->matchId;
    }

    public function setMatchId(Matchs $matchId)
    {
        $this->matchId = $matchId;

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

    public function getGoalId()
    {
        return $this->goalId;
    }

    public function setGoalId(Player $goalId)
    {
        $this->goalId = $goalId;

        return $this;
    }

    public function getAssistId()
    {
        return $this->assistId;
    }

    public function setAssistId(Player $assistId)
    {
        $this->assistId = $assistId;

        return $this;
    }
}