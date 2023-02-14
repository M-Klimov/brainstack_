<?php

namespace App\Controller;

use App\Entity\EntityInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class BaseController extends AbstractController
{
    protected function getEntityValidationErrors(ValidatorInterface $validator, EntityInterface $entity): array
    {
        $errors = $validator->validate($entity);
        $errorsResult = [];

        if (count($errors) > 0) {

            foreach ($errors as $error) {
                $errorsResult[] = $error->getMessage();
            }
        }

        return $errorsResult;
    }
}