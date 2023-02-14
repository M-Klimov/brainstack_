<?php

namespace App\Manager;

use App\Entity\BannerHitEntity;

interface BannerHitManagerInterface
{
    public function addOrUpdateTimestamp(BannerHitEntity $bannerHitEntity): void;
}