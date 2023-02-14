<?php

namespace App\Tests\Functional;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Messenger\MessageBusInterface;

abstract class AbstractTestCase extends KernelTestCase
{
    protected function getBus(KernelInterface $kernel): MessageBusInterface
    {
        return $kernel->getContainer()->get('messenger.default_bus');
    }

    protected function getEntityManager(KernelInterface $kernel): EntityManagerInterface
    {
        return $kernel->getContainer()->get('doctrine.orm.entity_manager');
    }
}