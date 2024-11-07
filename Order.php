<?php
class Order {
    public $id;
    public $customerName;
    public $status = "cart";
    public $totalPrice = 0;
    public $products = [];

    //Fonction permettant d'ajouter des produits
    public function addProducts()
    {
        if ($this->status === "cart") {
            $this->products[] = "Café";
            $this->totalPrice += 1;
        };
    }

    //Fonction permettant de payer
    public function pay()
    {
        if ($this->status === "cart") {
            $this->status = "paid";

        };
    }

    //Fonction permettant de supprimer les produits du panier
    public function removeProducts(){
        if ($this->status === "cart") {
            $this->products = [];
            $this->totalPrice = 0;
        }
    }
}

$order1 = new Order();
$order1->addProducts();
$order1->removeProducts();

var_dump($order1);