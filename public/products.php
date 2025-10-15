<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use App\Infra\FileProductRepository;
use App\Application\ListProductsService;

$file = __DIR__ . '/../storage/products.txt';

$listService = new ListProductsService(
    new FileProductRepository($file)
);

$products = $listService->listProducts();

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Produstos</title>
    <style>
        table {
            border-collapse: collapse;
            width: 60%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #aaa;
            padding: 8px 12px;
            text-align: left;
        }
        th {
            background-color: #eee;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>

<h1>Lista de Produtos</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Preço</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?= htmlspecialchars((string) $product['id']) ?></td>
                <td><?= htmlspecialchars($product['name']) ?></td>
                <td><?= htmlspecialchars((string) $product['price']) ?></td>
            </tr>
        <?php endforeach; ?>
    <tbody>
</table>
</body>
</html>