<?php

namespace Max\CafeSerenata\Domain\Models;

class Product
{
    private ?int $id;
    private string $name;
    private string $description;
    private string $image;
    private float $price;
    private string $type;

    public function __construct(
        ?int $id,
        string $name,
        string $description,
        float $price,
        string $type,
        string $image = "logo-serenatto.png",
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
        $this->price = $price;
        $this->type = $type;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage($imageName): void
    {
        $this->image = uniqid() . "-" . $imageName;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getPriceFormmated(): string
    {
        return "$ " . number_format($this->getPrice(), 2);
    }

    public function getPriceFormmatedEdit(): string
    {
        return number_format($this->getPrice(), 2);
    }

    public function getImagePath(): string
    {
        return "img/" . $this->getImage();
    }
}
