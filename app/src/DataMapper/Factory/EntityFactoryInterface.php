<?php

namespace App\DataMapper\Factory;

use App\Entity\EntityInterface;

interface EntityFactoryInterface
{
    public function getEntityObject(string $class): EntityInterface;
}