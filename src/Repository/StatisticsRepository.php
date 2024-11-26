<?php

namespace App\Repository;

use App\Entity\Statistics;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class StatisticsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Statistics::class);
    }

    public function save(Statistics $new, ?bool $isSave = false)
    {
        $this->getEntityManager()->persist($new);

        if($isSave)
        {
            $this->getEntityManager()->flush();
        }
        return $new;
    }
}    