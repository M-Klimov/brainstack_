<?php

namespace App\Http;

interface JsonRequestInterface
{
    public function getJsonData(): array;
}