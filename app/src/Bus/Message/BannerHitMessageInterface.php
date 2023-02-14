<?php
namespace App\Bus\Message;

interface BannerHitMessageInterface
{
    public function getIp(): string;
    public function getUserAgent(): string;
}