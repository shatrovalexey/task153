<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Repository;

use Doctrine\DBAL\Connection;
use Raketa\BackendTestTask\Repository\Entity\Product;

class ProductRepository
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function getByUuid(string $uuid): ?Product
    {
        return ($row = $this->connection->fetchOne('
SELECT
	p1.*
FROM
	products AS p1
WHERE
	(p1.uuid = :uuid);
		', [':uuid' => $uuid,])) ? $this->make($row) : null;
    }

    public function getByCategory(string $category): array
    {
        return array_map(
            static fn (array $row): Product => $this->make($row),
            $this->connection->fetchAllAssociative('
SELECT
	id
FROM
	products
WHERE
	(is_active = :is_active) AND
	(category = :category);
			', [
				':is_active' => 1
				, ':category' =>  $category,
			])
        );
    }

    public function make(array $row): Product
    {
        return new Product(... array_map(function (string $key) use (array &$row): array {
			return $row[$key];
        }, ['id', 'uuid', 'is_active', 'category', 'name', 'description', 'thumbnail', 'price',]));
    }
}
