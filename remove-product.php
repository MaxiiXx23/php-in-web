<?php

use Max\CafeSerenata\Infra\Database\ConnectionBD;
use Max\CafeSerenata\Infra\Repositories\ProductRepository\ProductRepository;

require_once 'vendor/autoload.php';

$connection = ConnectionBD::execute();

$productRepository = new ProductRepository($connection);

$id = $_POST['id'];

$productRepository->deleteById($id);

// redirecionando para a página admin.php através do cabeçalho HTTP/HTTPS

header("Location: admin.php");
