<?php

namespace App\Entity;

use App\Repository\ArcsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArcsRepository::class)]
class Arcs
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'arc_id')]
    private ?int $id;

    #[ORM\Column(type: 'string')]
    private ?string $name;

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
}