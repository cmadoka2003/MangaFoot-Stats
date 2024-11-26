<?php

namespace App\Repository;

use App\Entity\Favorite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class FavoriteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Favorite::class);
    }

    public function save(Favorite $new, ?bool $isSave = false)
    {
        $this->getEntityManager()->persist($new);

        if($isSave)
        {
            $this->getEntityManager()->flush();
        }
        return $new;
    }
}    