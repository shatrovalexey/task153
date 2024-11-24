<?php
namespace Raketa\BackendTestTask\Infrastructure;

use Psr\Http\Message\RequestInterface;

readonly class JsonRequest implements RequestInterface
{
	public function getBody(): StreamInterface
	{
		// ...
	}

	public function getData(bool $toArray = true)
	{
		return json_decode($this->getBody()->getContents(), $toArray);
	}

	// остальные методы, которые задекларированы для описания
}