<?php

declare(strict_types=1);

namespace App\Infra;

use App\Contracts\ProductRepository;

final class FileProductRepository implements ProductRepository
{
    private string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;

        $dir = dirname($this->filePath);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        if (!file_exists($this->filePath)) {
            touch($this->filePath);
        }
    }
    
    public function save(array $product): void
    {
        if (!isset($product['id'])) {
            $product['id'] = $this->getNextId();
        }

        file_put_contents(
            $this->filePath,
            json_encode($product, JSON_UNESCAPED_UNICODE) . PHP_EOL,
            FILE_APPEND
        );
    }

    public function findAll(): array
    {
        if(!file_exists($this->filePath)) {
            return [];
        }

        $lines = file($this->filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        $products = [];

        foreach($lines as $line) {
            $product = json_decode($line, true);

            if(is_array($product) && isset($product['id'], $product['name'], $product['price'])){
                $products[] = $product;
            }
        }

        return $products;
    }

    private function getNextId(): int
    {
        if (!file_exists($this->filePath) || filesize($this->filePath) === 0) {
            return 1;
        }

        $lines = file($this->filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $maxId = 0;

        foreach ($lines as $line) {
            $product = json_decode($line, true);
            if (isset($product['id']) && is_numeric($product['id']) && $product['id'] > $maxId) {
                $maxId = (int) $product['id'];
            }
        }

        return $maxId + 1;
    }
}
