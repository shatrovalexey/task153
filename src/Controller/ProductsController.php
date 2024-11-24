<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Raketa\BackendTestTask\View\ProductsView;
use Raketa\BackendTestTask\Infrastructure\Codec;
use Raketa\BackendTestTask\Controller\{JsonResponse, JsonRequest};

readonly class ProductsController
{
    public function __construct(
        private ProductsView $productsVew
    ) {
    }

    public function get(JsonRequest $request): JsonResponse
    {
        $response = new JsonResponse();
        $rawRequest = $request->getData();

        return $response->getResponse($this->productsVew->toArray($rawRequest['category']));
    }
}
