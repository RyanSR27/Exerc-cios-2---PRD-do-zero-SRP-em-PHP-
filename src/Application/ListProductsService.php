<?php

declare(strict_types=1);

namespace App\Application;

use App\Contracts\ProductRepository;

final class ListProductsService
{
    private ProductRepository $repository;

    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /** 
     * @return Products[]
     */
    
    public function listProducts(): array
    {
        $products = $this->repository->findAll();

        return $products;
    }
}