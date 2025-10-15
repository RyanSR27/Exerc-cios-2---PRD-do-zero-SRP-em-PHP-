<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Infra\FileProductRepository;
use App\Domain\SimpleProductValidator;
use App\Application\ProductService;

$file = __DIR__ . '/../storage/products.txt';

$product = new ProductService(
    new FileProductRepository($file),
    new SimpleProductValidator()
);

$response = $product->register($_POST);

http_response_code($response ? 201 : 422);

echo $response ? 'Produto cadastrado com sucesso' : 'Falha no cadastro do produto';