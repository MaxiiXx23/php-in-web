<?php

use Max\CafeSerenata\Domain\Models\Product;
use Max\CafeSerenata\Infra\Database\ConnectionBD;
use Max\CafeSerenata\Infra\Repositories\ProductRepository\ProductRepository;

require_once 'vendor/autoload.php';

$connection = ConnectionBD::execute();

$productRepository = new ProductRepository($connection);

$product = new Product(
    $_GET['id'],
    $_POST['nome'],
    $_POST['descricao'],
    $_POST['preco'],
    $_POST['tipo'],
);

// var_dump($_POST['delete_file']);
// exit();

if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {
    $product->setImage($_FILES['image']['name']);

    move_uploaded_file($_FILES['image']['tmp_name'], $product->getImagePath());

    $productRepository->update($product);
    $productRepository->updateImage($product);

    // Deletando o arquivo/imagem antiga da pasta
    if (file_exists($_POST['delete_file'])) {
        unlink($_POST['delete_file']);
    } else {
        echo "File does not exists";
    }

    return header("Location: admin.php");
}

$productRepository->update($product);


header("Location: admin.php");
