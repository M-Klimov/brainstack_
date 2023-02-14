<?php

namespace App\DataMapper;

use App\Entity\EntityInterface;

interface SimpleDataMapperInterface
{
    public function getMappedEntity(string $entityClass, array $data): EntityInterface;
}