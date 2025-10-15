<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SRP Demo</title>
    <style>
        body{
            font-family:system-ui,Segoe UI,Arial;
            margin:2rem
        }
        label{
            display:block;
            margin:.5rem 0;
        }
    </style>
</head>
<body>
    <h1>Cadastro de Produto</h1>
    <form action="create.php" method="POST">
        <label>Nome<input name="name" type="name" required></label>
        <label>Preço<input name="price" type="price" required></label>
        <button type="submit">Cadastrar</button>
    </form>
</body> 
</html>