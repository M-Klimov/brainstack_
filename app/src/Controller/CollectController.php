<?php

namespace App\Controller;

use App\DataMapper\SimpleDataMapperInterface;
use App\Entity\BannerHitEntity;
use App\Http\JsonRequestInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CollectController extends BaseController
{
    #[Route('/collect', name: 'app_collect', methods: ['POST'])]
    public function index(
        MessageBusInterface $bus,
        SimpleDataMapperInterface $dataMapper,
        JsonRequestInterface $jsonRequest,
        ValidatorInterface $validator
    ): JsonResponse
    {
        if (!$jsonRequest->getJsonData()) {
            return $this->json([], Response::HTTP_OK);
        }

        /**
         * @var $bannerHitEntity BannerHitEntity
         */
        $bannerHitEntity = $dataMapper->getMappedEntity(BannerHitEntity::class, $jsonRequest->getJsonData());

        $errors = $this->getEntityValidationErrors($validator, $bannerHitEntity);

        if ($errors) {
            return $this->json(['errors' => $errors], Response::HTTP_BAD_REQUEST);
        }

        $bannerHitEntity->computeIdentifier();

        $bus->dispatch($bannerHitEntity);

        return $this->json([], Response::HTTP_OK);
    }
}
