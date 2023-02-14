<?php

namespace App\Manager;

use App\Entity\BannerHitEntity;
use App\Repository\BannerHitEntityRepository;

readonly class BannerHitManager implements BannerHitManagerInterface
{
    public function __construct(private BannerHitEntityRepository $bannerHitEntityRepository)
    {

    }

    public function addOrUpdateTimestamp(BannerHitEntity $bannerHitEntity): void
    {
        $this->bannerHitEntityRepository->addOrUpdateTimestamp($bannerHitEntity);
    }
}