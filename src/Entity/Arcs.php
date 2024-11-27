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

    public function __construct()
    {
        $this->matchs = new ArrayCollection();
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
}
