<?php

namespace Max\CafeSerenata\Infra\Repositories\ProductRepository;

use Max\CafeSerenata\Domain\Models\Product;

interface IProductRepository
{
    public function getProductById(int $id): Product;
    public function getAllProdutcByCoffe(): array;
    public function getAllProdutcByLunch(): array;
    public function getAllProdutcs(): array;
    public function create(Product $product): void;
    public function update(Product $product): void;
    public function updateImage(Product $product): void;
    public function deleteById(int $id): void;
}
