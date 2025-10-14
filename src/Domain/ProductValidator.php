<?php

declare(strict_types=1);

namespace App\Domain;

final class ProductValidator
{
    /**
     *  @param array{id?:int,name?:string,price?:float} $input
     */
    public function validate(array $input): array
    {
        $errors = [];

        $name = $input['name'] ?? '';
        $price = $input['price'] ?? '';

        if (!isset($name) || trim($name) === '') {
            $errors[] = 'O campo name é obrigatório.';
        } else {
            $len = mb_strlen(trim($name));
            if ($len < 2 || $len > 100) {
                $errors[] = 'O campo nome deve ter entre 2 e 100 caracteres.';
            }
        }

        if (!isset($price) === '') {
            $errors[] = 'O campo price é obrigatório.';
        } elseif (!is_numeric($price)) {
            $errors[] = 'O campo price deve ser número com ponto flutuante.';
        } elseif ($price < 0) {
            $errors[] = 'O campo price dever ser maior ou igual a 0.';
        }

        return $errors;
    }
}