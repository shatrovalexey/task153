<?php

namespace Raketa\BackendTestTask\View;

use Raketa\BackendTestTask\Repository\Entity\Product;
use Raketa\BackendTestTask\Repository\ProductRepository;

readonly class ProductsView
{
    public function __construct(
        private ProductRepository $productRepository
    ) {
    }

	protected static function _getMethodName(string $key): string
	{
		return 'get' . ucfirst($key);
	}

    public function toArray(string $category): array
    {
        return array_map(
            fn (Product $product) => array_map(
				fn (string $key) => $product->{static::_getMethodName($key)}()
				, ['id', 'uuid', 'category', 'description', 'thumbnail', 'price',]
			), $this->productRepository->getByCategory($category)
        );
    }
}