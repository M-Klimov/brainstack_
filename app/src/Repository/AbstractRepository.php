<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

abstract class AbstractRepository extends ServiceEntityRepository
{
    private const DATETIME_FORMAT = 'Y-m-d H:i:s';
    protected function datetimeToString(\DateTimeInterface $dateTime): string
    {
        return $dateTime->format(self::DATETIME_FORMAT);
    }
}