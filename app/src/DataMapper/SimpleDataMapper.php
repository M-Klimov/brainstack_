<?php

namespace App\DataMapper;

use App\DataMapper\Factory\EntityFactoryInterface;
use App\Entity\EntityInterface;

class SimpleDataMapper implements SimpleDataMapperInterface
{
    private const SET = 'set';

    public function __construct(private readonly EntityFactoryInterface $entityFactory)
    {

    }
    public function getMappedEntity(string $entityClass, array $data): EntityInterface
    {
        $entity = $this->entityFactory->getEntityObject($entityClass);
        $this->setDataToEntity($entity, $data);

        return $entity;
    }

    private function setDataToEntity(EntityInterface $entity, array $data): void
    {
        foreach ($data as $key => $value) {
            $method = $this->getSetterName($key);
            if (method_exists($entity, $method)) {
                $entity->$method($value);
            }
        }
    }

    private function getSetterName(string $propertyName): string
    {
        return self::SET . ucfirst($propertyName);
    }
}