<?php

namespace Max\CafeSerenata\Infra\Repositories\ProductRepository;

use Max\CafeSerenata\Domain\Models\Product;
use Max\CafeSerenata\Infra\Repositories\ProductRepository\IProductRepository;
use PDO;
use PDOStatement;

require_once 'vendor/autoload.php';

class ProductRepository implements IProductRepository
{
    private PDO $pdo;

    public function __construct(PDO $connection)
    {
        $this->pdo = $connection;
    }

    public function getAllProdutcs(): array
    {
        $sqlQuery = "SELECT id, nome, descricao, preco, imagem, tipo FROM produtos;";
        $stmt = $this->pdo->query($sqlQuery);

        return $this->hydrateProductList($stmt);
    }

    public function getAllProdutcByCoffe(): array
    {
        $sqlQuery = "SELECT id, nome, descricao, preco, imagem, tipo FROM produtos WHERE tipo = 'Café' ORDER BY preco;";
        $stmt = $this->pdo->query($sqlQuery);

        return $this->hydrateProductList($stmt);
    }

    public function getAllProdutcByLunch(): array
    {
        $sqlQuery = "SELECT id, nome, descricao, preco, imagem, tipo FROM produtos WHERE tipo = 'Almoço' ORDER BY preco;";
        $stmt = $this->pdo->query($sqlQuery);

        return $this->hydrateProductList($stmt);
    }

    public function create(Product $product): void
    {
        $sqlQuery = "INSERT INTO produtos (nome, descricao, preco, tipo, imagem) 
                    VALUES (:name, :descricao, :preco, :tipo, :imagem);";

        $stmt = $this->pdo->prepare($sqlQuery);
        $stmt->execute([
            ":name" => $product->getName(),
            ":descricao" => $product->getDescription(),
            ":preco" => $product->getPrice(),
            ":tipo" => $product->getType(),
            ":imagem" => $product->getImage(),
        ]);
    }

    public function update(Product $product): void
    {
        $sqlQuery = "UPDATE produtos SET 
            nome=:name, descricao=:description, preco=:price, tipo=:type WHERE id=:id;";

        $stmt = $this->pdo->prepare($sqlQuery);
        $stmt->execute([
            ":id" => $product->getId(),
            ":name" => $product->getName(),
            ":description" => $product->getDescription(),
            ":price" => $product->getPrice(),
            ":type" => $product->getType(),
        ]);
    }

    public function updateImage(Product $product): void
    {
        $sqlQuery = "UPDATE produtos SET 
            imagem=:image WHERE id=:id";

        $stmt = $this->pdo->prepare($sqlQuery);
        $stmt->execute([
            ":id" => $product->getId(),
            ":image" => $product->getImage(),
        ]);
    }

    public function getProductById(int $id): Product
    {
        $sqlQuery = "SELECT id, nome, descricao, preco, imagem, tipo FROM produtos WHERE id =:id;";
        $stmt = $this->pdo->prepare($sqlQuery);
        $stmt->bindValue(":id", $id);
        $stmt->execute();

        $product = $this->hydrateProduct($stmt);
        return $product;
    }

    public function deleteById(int $id): void
    {
        $sqlQuery = "DELETE FROM produtos WHERE id=:id;";
        $stmt = $this->pdo->prepare($sqlQuery);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
    }

    private function hydrateProductList(PDOStatement $stmt): array
    {

        $productDataList = $stmt->fetchAll();

        $productList = array_map(function ($productData) {
            $product = new Product(
                $productData['id'],
                $productData['nome'],
                $productData['descricao'],
                $productData['preco'],
                $productData['tipo'],
                $productData['imagem'],
            );
            return $product;
        }, $productDataList);

        return $productList;
    }

    private function hydrateProduct(PDOStatement $stmt): Product
    {

        $productData = $stmt->fetch();

        $product = new Product(
            $productData['id'],
            $productData['nome'],
            $productData['descricao'],
            $productData['preco'],
            $productData['tipo'],
            $productData['imagem'],
        );
        return $product;
    }
}
