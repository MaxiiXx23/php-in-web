<?php

use Max\CafeSerenata\Domain\Models\Product;
use Max\CafeSerenata\Infra\Database\ConnectionBD;
use Max\CafeSerenata\Infra\Repositories\ProductRepository\ProductRepository;

require_once 'vendor/autoload.php';

$connection = ConnectionBD::execute();

$productRepository = new ProductRepository($connection);

$product = new Product(
    null,
    $_POST['nome'],
    $_POST['descricao'],
    $_POST['preco'],
    $_POST['tipo'],
);

if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
    $product->setImage($_FILES['image']['name']);

    move_uploaded_file($_FILES['image']['tmp_name'], $product->getImagePath());

    $productRepository->create($product);

    return header("Location: admin.php");
}

$productRepository->create($product);


header("Location: admin.php");
