<?php

namespace App\Repository;

use App\Entity\PlayersTeam;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class PlayersTeamRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlayersTeam::class);
    }

    public function save(PlayersTeam $new, ?bool $isSave = false)
    {
        $this->getEntityManager()->persist($new);

        if($isSave)
        {
            $this->getEntityManager()->flush();
        }
        return $new;
    }
}    