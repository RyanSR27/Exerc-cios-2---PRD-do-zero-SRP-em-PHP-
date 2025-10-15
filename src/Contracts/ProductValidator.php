<?php

declare(strict_types=1);

namespace App\Contracts;

interface ProductValidator
{
    /**
     *  @param array{id?:int,name?:string,price?:float} $product
     */
    public function validate(array $product): array;
}