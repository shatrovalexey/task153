### ИСПРАВЛЕНИЯ
* исправил миграцию
* создал классы Raketa\BackendTestTask\Infrastructure\{JsonRequest, Codec, ConnectorException}
* в Raketa\BackendTestTask\Infrastructure\Codec перенёс всё что связано с кодированием
* доработал класс Raketa\BackendTestTask\Infrastructure\JsonResponse
* заменил Raketa\BackendTestTask\Controller\{AddToCartController, GetCartController} на Raketa\BackendTestTask\Controller\CartController
* переименовал и доработал класс Raketa\BackendTestTask\Controller\GetProductsController на Raketa\BackendTestTask\Controller\ProductsController
* доработал класс Raketa\BackendTestTask\Repository\CartManager
* исправил класс Raketa\BackendTestTask\Repository\ProductRepository. Устранил угрозу SQL-инъекций