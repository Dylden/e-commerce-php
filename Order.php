<?php
class Order {
    public $id;
    public $customerName;
    public $status = "cart";
    public $totalPrice = 0;
    public $products = [];
    public function addProducts()
    {
        if ($this->status === "cart") {
            $this->products[] = "Café";
            $this->totalPrice += 1;
        };
    }
    public function pay()
    {
        if ($this->status === "cart") {
            $this->status = "paid";

        };
    }

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