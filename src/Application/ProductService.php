<?php

declare(strict_types=1);

namespace App\Application;

use App\Domain\ProductRepository;
use App\Domain\ProductValidator;

final class ProductService
{
    private ProductRepository $repository;
    private ProductValidator $validator;

    public function __construct(ProductRepository $repository, ProductValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     *  @param array{id?:int,name?:string,price?:float}
     */
    public function register(array $input): bool
    {

        $errors = $this->validator->validate($input);
        if ($errors !== []) {
            return false;
        }

        $product = [
            'id' => ,
            'name' => $input['name'] ?? 'Sem Nome',
            'price' => (float) $input['price']
        ];

        $this->repository->save($product);
        return true;
    }
}