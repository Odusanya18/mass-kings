<?php

/*
 * This file is part of the Mass-Kings package.
 *
 * (c) Victor Odusanya <odusanya18@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Repository;

use App\Entity\Appointment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Appointment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Appointment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Appointment[]    findAll()
 * @method Appointment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AppointmentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Appointment::class);
    }

    public function hasAppointmentAt(\DateTimeImmutable $date): bool
    {
        return $this->createQueryBuilder('a')
            ->select('1')
            ->where('a.time BETWEEN :startTime AND :endTime')
            ->setParameters([
                'startTime' => $this->roundToPreviousHour($date),
                'endTime' => $this->roundToNextHour($date),
            ])
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult() ? true : false;
    }

    private function roundToPreviousHour(\DateTimeImmutable $date): \DateTimeImmutable
    {
        return (new \DateTimeImmutable())->setTime($date->format('H'), 0, 0);
    }

    private function roundToNextHour(\DateTimeImmutable $date): \DateTimeImmutable
    {
        return \DateTimeImmutable::createFromMutable((\DateTime::createFromImmutable($this->roundToPreviousHour($date)))
            ->add(new \DateInterval('PT1H')));
    }
}
