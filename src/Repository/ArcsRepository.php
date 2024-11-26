<?php

namespace App\Repository;

use App\Entity\Arcs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ArcsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Arcs::class);
    }

    public function save(Arcs $new, ?bool $isSave = false)
    {
        $this->getEntityManager()->persist($new);

        if($isSave)
        {
            $this->getEntityManager()->flush();
        }
        return $new;
    }
}    