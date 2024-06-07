<?php

use Max\CafeSerenata\Infra\Database\ConnectionBD;
use Max\CafeSerenata\Infra\Repositories\ProductRepository\ProductRepository;

require_once 'vendor/autoload.php';

$connection = ConnectionBD::execute();

$productRepository = new ProductRepository($connection);
$allProducts = $productRepository->getAllProdutcs();

?>
<style>
    table {
        width: 90%;
        margin: auto 0;
    }

    table,
    th,
    td {
        border: 1px solid #000;
    }

    table th {
        padding: 11px 0 11px;
        font-weight: bold;
        font-size: 18px;
        text-align: left;
        padding: 8px;
    }

    table tr {
        border: 1px solid #000;
    }

    table td {
        font-size: 18px;
        padding: 8px;
    }

    .container-admin-banner h1 {
        margin-top: 40px;
        font-size: 30px;
    }
</style>

<table>
    <thead>
        <tr>
            <th>Produto</th>
            <th>Tipo</th>
            <th>Descricão</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($allProducts as $product) { ?>
            <tr>
                <td><?= $product->getName() ?></td>
                <td><?= $product->getType() ?></td>
                <td><?= $product->getDescription() ?></td>
                <td><?= $product->getPriceFormmated() ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>