<?php

namespace App\Entity;

use App\Repository\RatingRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RatingRepository::class)]
class Rating
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'rating_id')]
    private ?int $id;

    #[ORM\Column(type: 'integer')]
    private ?int $rating;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "rating")]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'user_id', nullable: false)]
    private $userId;

    #[ORM\ManyToOne(targetEntity: Statistics::class, inversedBy: "rating")]
    #[ORM\JoinColumn(name: 'statistics_id', referencedColumnName: 'statistics_id', nullable: false)]
    private $statisticsId;

    public function getId()
    {
        return $this->id;
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function setRating($rating)
    {
        $this->rating = $rating;

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

    public function getStatisticsId()
    {
        return $this->statisticsId;
    }

    public function setStatisticsId(Statistics $statisticsId)
    {
        $this->statisticsId = $statisticsId;

        return $this;
    }
}

