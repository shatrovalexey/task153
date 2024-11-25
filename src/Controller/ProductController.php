<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Controller;

use Raketa\BackendTestTask\View\ProductView;
use Raketa\BackendTestTask\Infrastructure\Codec;
use Raketa\BackendTestTask\Controller\{JsonResponse, JsonRequest};

readonly class ProductController
{
    public function __construct(
        private ProductView $productsVew
    ) {
    }

    public function get(JsonRequest $request): JsonResponse
    {
        $response = new JsonResponse();
        $rawRequest = $request->getData();

        return $response->getResponse($this->productVew->toArray($rawRequest['category']));
    }
}