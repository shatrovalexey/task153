<?php

declare(strict_types = 1);

namespace Raketa\BackendTestTask\Infrastructure;

use Raketa\BackendTestTask\Domain\Cart;
use Redis;
use Raketa\BackendTestTask\Infrastructure\{Codec, ConnectorException};

class Connector
{
	protected const DELAY = 24 * 60 * 60;
    protected Redis $redis;

    public function __construct(protected Redis $redis)
    {
    }

    /**
     * @throws ConnectorException
     */
    public function get(string $key)
    {
        try {
            return Codec::decode($this->redis->get($key));
        } catch (ConnectorException $e) {
            throw $e;
        }
    }

    /**
     * @throws ConnectorException
     */
    public function set(string $key, Cart $value)
    {
        try {
            $this->redis->setex($key, static::DELAY, Codec::encode($value));
        } catch (ConnectorException $e) {
            throw $e;
        }
    }

    public function has(string $key): bool
    {
        return $this->redis->exists($key);
    }
}