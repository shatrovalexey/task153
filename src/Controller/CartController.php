<?php

namespace Raketa\BackendTestTask\Controller;

use Raketa\BackendTestTask\Domain\{CartItem, Cart};
use Raketa\BackendTestTask\Repository\{CartManager, ProductRepository};
use Raketa\BackendTestTask\View\CartView;
use Raketa\BackendTestTask\Infrastructure\{JsonResponse, JsonRequest};

readonly class CartController
{
    public function __construct(
        private ProductRepository $productRepository
		, private CartView $cartView
		, private CartManager $cartManager,
    ) {
		$this->response = new JsonResponse();
    }

	protected static function _getResponse(?Cart $data = null, int $status = 200): JsonResponse
	{
		return $this->response->getResponse([
			'cart' => $this->cartView->toArray($cart)
			, 'status' => match($status) {
					200 => 'success'
					, default => 'failure',
		], $status);
	}

    public function actionRemove(JsonRequest $request): JsonResponse
    {
        $rawRequest = $request->getData();
        $product = $this->productRepository->getByUuid($rawRequest['productUuid']);

        $cart = $this->cartManager->getCart();
        $cart->removeItem($product, $rawRequest['quantity']);

        return $this->_getResponse($cart);
	}

    public function actionAdd(JsonRequest $request): JsonResponse
    {
        $rawRequest = $request->getData();
        $product = $this->productRepository->getByUuid($rawRequest['productUuid']);

        $cart = $this->cartManager->getCart();
        $cart->addItem($product, $rawRequest['quantity']);

		return $this->_getResponse($cart);
    }

    public function actionList(JsonRequest $request): JsonResponse
    {
        $cart = $this->cartManager->getCart();

		return $cart
			? $this->_getResponse($cart)
			: $this->response->getResponse(['message' => 'Cart not found',], 404);
    }
}