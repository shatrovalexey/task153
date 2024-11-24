<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Domain;

use Raketa\BackendTestTask\Infrastructure\Codec;

final readonly class CartItem
{
	public ?string $uuid;

    public function __construct(
        public string $productUuid,
        public float $price,
        public int $quantity,
    ) {
		$this->uuid = static::getUuid();
    }

    public static function getUuid(): string
    {
		return Codec::uuid();
    }

    public function getProductUuid(): string
    {
        return $this->productUuid;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
