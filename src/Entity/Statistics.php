<?php

namespace App\Entity;

use App\Repository\StatisticsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatisticsRepository::class)]
class Statistics
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'statistics_id')]
    private ?int $id;

    #[ORM\Column(type: 'boolean')]
    private ?bool $goalkeeper;

    #[ORM\Column(type: 'integer', name: 'shots_on_target')]
    private ?int $shotsOnTarget;

    #[ORM\Column(type: 'integer', name: 'shots_off_target')]
    private ?int $shotsOffTarget;

    #[ORM\Column(type: 'integer', name: 'blocked_shots')]
    private ?int $blockedShots;

    #[ORM\Column(type: 'integer')]
    private ?int $touches;

    #[ORM\Column(type: 'integer', name: 'pass_attempts')]
    private ?int $passAttempts;

    #[ORM\Column(type: 'integer', name: 'successful_passes')]
    private ?int $sussessfulPasses;

    #[ORM\Column(type: 'integer', name: 'dribble_attempts')]
    private ?int $dribbleAttempts;

    #[ORM\Column(type: 'integer', name: 'successful_dribbles')]
    private ?int $sussessfulDribbles;

    #[ORM\Column(type: 'integer', name: 'crosse_attempts')]
    private ?int $crosseAttempts;

    #[ORM\Column(type: 'integer', name: 'successful_crosses')]
    private ?int $sussessfulCrosses;

    #[ORM\Column(type: 'integer', name: 'tackle_attempts')]
    private ?int $tackleAttempts;

    #[ORM\Column(type: 'integer', name: 'successful_tackles')]
    private ?int $sussessfulTackles;

    #[ORM\Column(type: 'integer', name: 'aerial_duels')]
    private ?int $aerialDuels;

    #[ORM\Column(type: 'integer', name: 'possession_lost')]
    private ?int $possessionLost;

    #[ORM\Column(type: 'integer')]
    private ?int $clearences;

    #[ORM\Column(type: 'integer')]
    private ?int $interceptions;

    #[ORM\Column(type: 'integer', name: 'dribbled_past')]
    private ?int $dribbledPast;

    #[ORM\Column(type: 'integer')]
    private ?int $fouls;

    #[ORM\Column(type: 'integer', name: 'yellow_cards')]
    private ?int $yellowCards;

    #[ORM\Column(type: 'integer', name: 'red_cards')]
    private ?int $redCards;

    #[ORM\Column(type: 'integer')]
    private ?int $punches;

    #[ORM\Column(type: 'integer')]
    private ?int $saves;

    #[ORM\Column(type: 'integer', name: 'saves_from_inside_box')]
    private ?int $savesFromInsideBox;

    #[ORM\Column(type: 'integer', name: 'goal_conceded')]
    private ?int $goalConceded;

    #[ORM\ManyToOne(targetEntity: Matchs::class, inversedBy: "statistics")]
    #[ORM\JoinColumn(name: 'match_id', referencedColumnName: 'match_id', nullable: false)]
    private $matchId;

    #[ORM\ManyToOne(targetEntity: Player::class, inversedBy: "statistics")]
    #[ORM\JoinColumn(name: 'player_id', referencedColumnName: 'player_id', nullable: false)]
    private $playerId;

    #[ORM\ManyToOne(targetEntity: Teams::class, inversedBy: "statistics")]
    #[ORM\JoinColumn(name: 'team_id', referencedColumnName: 'team_id', nullable: false)]
    private $teamId;

    #[ORM\ManyToOne(targetEntity: Arcs::class, inversedBy: "statistics")]
    #[ORM\JoinColumn(name: 'arc_id', referencedColumnName: 'arc_id', nullable: false)]
    private $arcs;

    #[ORM\OneToMany(
        targetEntity: Rating::class,
        mappedBy: "statisticsId",
        cascade: ['persist', 'remove']
    )]
    private $rating;

    public function __construct()
    {
        $this->rating = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getGoalkeeper()
    {
        return $this->goalkeeper;
    }

    public function setGoalkeeper($goalkeeper)
    {
        $this->goalkeeper = $goalkeeper;

        return $this;
    }

    public function getShotsOnTarget()
    {
        return $this->shotsOnTarget;
    }

    public function setShotsOnTarget($shotsOnTarget)
    {
        $this->shotsOnTarget = $shotsOnTarget;

        return $this;
    }

    public function getShotsOffTarget()
    {
        return $this->shotsOffTarget;
    }

    public function setShotsOffTarget($shotsOffTarget)
    {
        $this->shotsOffTarget = $shotsOffTarget;

        return $this;
    }

    public function getBlockedShots()
    {
        return $this->blockedShots;
    }

    public function setBlockedShots($blockedShots)
    {
        $this->blockedShots = $blockedShots;

        return $this;
    }

    public function getTouches()
    {
        return $this->touches;
    }

    public function setTouches($touches)
    {
        $this->touches = $touches;

        return $this;
    }

    public function getPassAttempts()
    {
        return $this->passAttempts;
    }

    public function setPassAttempts($passAttempts)
    {
        $this->passAttempts = $passAttempts;

        return $this;
    }

    public function getSussessfulPasses()
    {
        return $this->sussessfulPasses;
    }

    public function setSussessfulPasses($sussessfulPasses)
    {
        $this->sussessfulPasses = $sussessfulPasses;

        return $this;
    }

    public function getDribbleAttempts()
    {
        return $this->dribbleAttempts;
    }

    public function setDribbleAttempts($dribbleAttempts)
    {
        $this->dribbleAttempts = $dribbleAttempts;

        return $this;
    }

    public function getSussessfulDribbles()
    {
        return $this->sussessfulDribbles;
    }

    public function setSussessfulDribbles($sussessfulDribbles)
    {
        $this->sussessfulDribbles = $sussessfulDribbles;

        return $this;
    }

    public function getCrosseAttempts()
    {
        return $this->crosseAttempts;
    }

    public function setCrosseAttempts($crosseAttempts)
    {
        $this->crosseAttempts = $crosseAttempts;

        return $this;
    }

    public function getSussessfulCrosses()
    {
        return $this->sussessfulCrosses;
    }

    public function setSussessfulCrosses($sussessfulCrosses)
    {
        $this->sussessfulCrosses = $sussessfulCrosses;

        return $this;
    }

    public function getTackleAttempts()
    {
        return $this->tackleAttempts;
    }

    public function setTackleAttempts($tackleAttempts)
    {
        $this->tackleAttempts = $tackleAttempts;

        return $this;
    }

    public function getSussessfulTackles()
    {
        return $this->sussessfulTackles;
    }

    public function setSussessfulTackles($sussessfulTackles)
    {
        $this->sussessfulTackles = $sussessfulTackles;

        return $this;
    }

    public function getAerialDuels()
    {
        return $this->aerialDuels;
    }

    public function setAerialDuels($aerialDuels)
    {
        $this->aerialDuels = $aerialDuels;

        return $this;
    }

    public function getPossessionLost()
    {
        return $this->possessionLost;
    }

    public function setPossessionLost($possessionLost)
    {
        $this->possessionLost = $possessionLost;

        return $this;
    }

    public function getClearences()
    {
        return $this->clearences;
    }

    public function setClearences($clearences)
    {
        $this->clearences = $clearences;

        return $this;
    }

    public function getInterceptions()
    {
        return $this->interceptions;
    }

    public function setInterceptions($interceptions)
    {
        $this->interceptions = $interceptions;

        return $this;
    }

    public function getDribbledPast()
    {
        return $this->dribbledPast;
    }

    public function setDribbledPast($dribbledPast)
    {
        $this->dribbledPast = $dribbledPast;

        return $this;
    }

    public function getFouls()
    {
        return $this->fouls;
    }

    public function setFouls($fouls)
    {
        $this->fouls = $fouls;

        return $this;
    }

    public function getYellowCards()
    {
        return $this->yellowCards;
    }

    public function setYellowCards($yellowCards)
    {
        $this->yellowCards = $yellowCards;

        return $this;
    }

    public function getRedCards()
    {
        return $this->redCards;
    }

    public function setRedCards($redCards)
    {
        $this->redCards = $redCards;

        return $this;
    }

    public function getPunches()
    {
        return $this->punches;
    }

    public function setPunches($punches)
    {
        $this->punches = $punches;

        return $this;
    }

    public function getSaves()
    {
        return $this->saves;
    }

    public function setSaves($saves)
    {
        $this->saves = $saves;

        return $this;
    }

    public function getSavesFromInsideBox()
    {
        return $this->savesFromInsideBox;
    }

    public function setSavesFromInsideBox($savesFromInsideBox)
    {
        $this->savesFromInsideBox = $savesFromInsideBox;

        return $this;
    }

    public function getGoalConceded()
    {
        return $this->goalConceded;
    }

    public function setGoalConceded($goalConceded)
    {
        $this->goalConceded = $goalConceded;

        return $this;
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function addRating(Rating $rating)
    {
        $rating->setStatisticsId($this);
        $this->rating->add($rating);
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

    public function getArcs()
    {
        return $this->arcs;
    }

    public function setArcs(Arcs $arcs)
    {
        $this->arcs = $arcs;

        return $this;
    }
}