<?php

namespace App\DataMapper\Factory;

use App\Entity\EntityInterface;

class EntityFactory implements EntityFactoryInterface
{
    public function getEntityObject(string $class): EntityInterface
    {
        return new $class;
    }
}