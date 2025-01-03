<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentRepository::class)]
class Comment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: 'comment_id')]
    private ?int $id;

    #[ORM\Column(type: 'text')]
    private ?string $message;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "comment")]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'user_id', nullable: false)]
    private $userId;

    public function getId()
    {
        return $this->id;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;

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
}