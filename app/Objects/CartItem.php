<?php

namespace App\Objects;

class CartItem {
    private $id;
    private $name;
    private $description;
    private $price;
    private $quantity;

    public function __construct($product, $quantity)
    {
        $this->id = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->quantity = $quantity;
    }

    public function quantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        return $this->quantity = $quantity;
    }
}