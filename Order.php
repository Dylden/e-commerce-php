<?php

class Order
{
    public $id;
    public $customerName;
    public $status = "cart";
    public $totalPrice = 0;
    public $products = [];
    public $createdAt;
    public $shippingAdress;

    //méthode magique
    public function _construct($customerName, $price)
    {
        $this->customerName = $customerName;
        $this->id = uniqid();
    }

    //Fonction permettant d'ajouter des produits
    public function addProducts()
    {
        if ($this->status === "cart") {
            $this->products[] = "Café";
            $this->totalPrice += 1;
        } else{
            throw new Exception("Une erreur est survenue");
        };
    }
    public function setShippingAddress($shippingAddress)
    {
        if ($this->status === "cart") {
            $this->shippingAddress = $shippingAddress;
            $this->status = "shippingAddressSet";
        } else {
            throw new Exception('Veuillez saisir une adresse de livraison');
        }
    }

    //Fonction permettant de payer
    public function pay()
    {
        if ($this->status === "shippingAddressSet" && !empty($this->products)) {
            $this->status = "paid";

        } else {
            throw new Exception('Vous ne pouvez pas payer, merci de remplir votre adresse d\'abord');
        };
    }

    //Fonction permettant de supprimer les produits du panier
    public function removeProducts()
    {
        if ($this->status === "cart" && ($this->products)) {
            array_pop($this->products);
            $this->totalPrice -= 1;
        } else {
            echo "Vous n\'avez aucun produit à supprimer";
        }
    }
    public function ship()
    {
        if ($this->status === "paid") {
            $this->status = "shipped";

        } else {
            throw new Exception('La commande ne peut pas être expédiée. Elle n\'est pas encore payée');
        }
    }
}

$order1 = new Order();
$order1->addProducts();
$order1->addProducts();
$order1->setShippingAddress("20 rue du NomDeRue");
$order1->pay();
$order1->ship();

var_dump($order1);
