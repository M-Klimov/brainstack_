<?php

namespace App\Bus\MessageHandler;

use App\Bus\Message\BannerHitMessageInterface;
use App\Manager\BannerHitManagerInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class BannerHitMessageHandler
{
    public function __construct(private readonly BannerHitManagerInterface $bannerHitManager)
    {

    }

    public function __invoke(BannerHitMessageInterface $bannerHitMessage)
    {
        $this->bannerHitManager->addOrUpdateTimestamp($bannerHitMessage);
    }
}