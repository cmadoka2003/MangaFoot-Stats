<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'user_id')]
    private ?int $id;

    #[ORM\Column(type: 'string', nullable: true)]
    private ?string $avatar = null;

    #[ORM\Column(type: 'string', length: 50)]
    private ?string $pseudo;

    #[ORM\Column(type: 'string', length: 50, unique: true)]
    private ?string $email;

    #[ORM\Column(type: 'string')]
    private ?string $password;

    #[ORM\Column(type: 'json')]
    private array $roles = [];

    #[ORM\OneToMany(
        targetEntity: Favorite::class,
        mappedBy: "userId",
        cascade: ['persist', 'remove']
    )]
    private $favorite;

    #[ORM\OneToMany(
        targetEntity: Comment::class,
        mappedBy: "userId",
        cascade: ['persist', 'remove']
    )]
    private $comment;

    #[ORM\OneToMany(
        targetEntity: Rating::class,
        mappedBy: "userId",
        cascade: ['persist', 'remove']
    )]
    private $rating;

    public function __construct()
    {
        $this->favorite = new ArrayCollection();
        $this->comment = new ArrayCollection();
        $this->rating = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    public function getUserIdentifier(): string {
        return (string) $this->email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword() : string
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getSalt(): ?string {
        return null;
    }

    public function eraseCredentials(): void {}

    public function getRoles(): array {
        $roles = $this->roles;
        $roles[] = 'ROLE_USER';
    
        return array_unique($roles);
    }

    public function getFavorite()
    {
        return $this->favorite;
    }

    public function addFavorite(Favorite $favorite)
    {
        $favorite->setUserId($this);
        $this->favorite->add($favorite);
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function addComment(Comment $comment)
    {
        $comment->setUserId($this);
        $this->comment->add($comment);
    }

    public function getRating()
    {
        return $this->rating;
    }

    public function addRating(Rating $rating)
    {
        $rating->setUserId($this);
        $this->rating->add($rating);
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