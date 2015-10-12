<?php

namespace AppBundle\Repository;

class NotificationRepository extends \Doctrine\ORM\EntityRepository
{

    public function findReadyToSendByEmail($email){

        $date = \DateTime::createFromFormat('Y-m-d H:i:s', strtotime("-1 day"));

        $qb = $this->createQueryBuilder('n');
        return $qb
                ->where('n.email', ':email')
                ->andWhere($qb->expr()->lte('n.createdAt', $date))
                ->setParameter('email', $email)
                ->getQuery()
                ->getResult()
        ;
    }
}
