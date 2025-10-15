<?php

declare(strict_types=1); 

namespace App\Domain;

use App\Contracts\ProductValidator;

final class SimpleProductValidator implements ProductValidator
{
    /**
     * @param array{id:int, name?:string, price:float} $product
     * @return array<int, string> Lista de mensagens de erro
     */
    public function validate(array $product): array
    {
        $errors = [];

        $name = $product['name'] ?? '';
        $price = $product['price'] ?? null;


        if ($name === null || trim($name) === '') {
            $errors[] = 'O campo nome é obrigatório.';
        } else {
            $len = mb_strlen(trim($name));
            if ($len < 2 || $len > 100) {
                $errors[] = 'O campo nome deve ter entre 2 e 100 caracteres.';
            }
        }

        if ($price === null || $price === '') {
            $errors[] = 'O campo price é obrigatório.';
        } elseif (!is_numeric($price)) {
            $errors[] = 'O campo price deve ser número com ponto flutuante.';
        } elseif ((float)$price < 0) {
            $errors[] = 'O campo price deve ser maior ou igual a 0.';
        }

        return $errors;
    }
}
