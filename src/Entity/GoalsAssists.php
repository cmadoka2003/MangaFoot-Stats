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

    public function getId()
    {
        return $this->id;
    }
}