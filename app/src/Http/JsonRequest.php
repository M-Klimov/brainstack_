<?php

namespace App\Http;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class JsonRequest implements JsonRequestInterface
{
    private Request $request;
    private array $jsonData;

    public function __construct(RequestStack $requestStack)
    {
        $this->request = $requestStack->getCurrentRequest() ?? Request::create('/');
        $this->jsonData = json_decode($this->request->getContent(), true) ?? [];
    }

    public function getJsonData(): array
    {
        return $this->jsonData;
    }
}