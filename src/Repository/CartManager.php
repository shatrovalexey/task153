<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Repository;

use Exception;
use Psr\Log\LoggerInterface;
use Raketa\BackendTestTask\Domain\Cart;
use Raketa\BackendTestTask\Infrastructure\ConnectorFacade;

class CartManager extends ConnectorFacade
{
    public LoggerInterface $logger;

    public function __construct($host, $port, $password)
    {
        parent::__construct($host, $port, $password, 1);
        parent::build();
    }

    public function setLogger(LoggerInterface $logger): static
    {
        $this->logger = $logger;

		return $this;
    }

    /**
     * @inheritdoc
     */
    public function saveCart(Cart $cart): bool
    {
        try {
            return $this->connector->set($cart, session_id());
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }
    }

    /**
     * @return ?Cart
     */
    public function getCart(): ?Cart
    {
        try {
            return $this->connector->get(session_id());
        } catch (Exception $e) {
            $this->logger->error($e->getMessage());
        }

        return new Cart(session_id(), []);
    }
}
