<?php

namespace App\Repository;

use App\Entity\Matchs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MatchsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Matchs::class);
    }

    public function save(Matchs $new, ?bool $isSave = false)
    {
        $this->getEntityManager()->persist($new);

        if($isSave)
        {
            $this->getEntityManager()->flush();
        }
        return $new;
    }
}    