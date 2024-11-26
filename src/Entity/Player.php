<?php

namespace App\Entity;

use App\Repository\PlayerRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlayerRepository::class)]
class Player
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'player_id')]
    private ?int $id;

    #[ORM\Column(type: 'string')]
    private ?string $avatar;

    #[ORM\Column(type: 'string')]
    private ?string $firstname;

    #[ORM\Column(type: 'string')]
    private ?string $lastname;

    #[ORM\Column(type: 'integer')]
    private ?int $age;

    #[ORM\Column(type: 'string')]
    private ?string $birthdate;

    #[ORM\Column(type: 'string')]
    private ?string $height;

    #[ORM\Column(type: 'string')]
    private ?string $position_favorite;

    #[ORM\Column(type: 'string')]
    private ?string $country;

    #[ORM\Column(type: 'integer')]
    private ?string $number;

    public function getId()
    {
        return $this->id;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    public function getBirthdate()
    {
        return $this->birthdate;
    }

    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    public function getPosition_favorite()
    {
        return $this->position_favorite;
    }

    public function setPosition_favorite($position_favorite)
    {
        $this->position_favorite = $position_favorite;

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

    public function getNumber()
    {
        return $this->number;
    }

    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }
}