<?php

namespace AppBundle\Repository;

class NotificationRepository extends \Doctrine\ORM\EntityRepository
{

    public function findReadyToSendByEmail($email){

        $date = date('Y-m-d H:i:s', strtotime("-1 day"));

        $qb = $this->createQueryBuilder('n');
        return $qb
                ->where($qb->expr()->eq('n.email', ':email'))
                ->andWhere($qb->expr()->lte('n.createdAt', ':date'))
                ->setParameter('email', $email)
                ->setParameter('date', $date)
                ->getQuery()
                ->getResult()
        ;
    }
}
