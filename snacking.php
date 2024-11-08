<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class VendorMachine
{
    public $snacks = [
        [
            "name" => "Snickers",
            "price" => 1,
            "quantity" => 5
        ],
        [
            "name" => "Mars",
            "price" => 1.5,
            "quantity" => 5
        ],
        [
            "name" => "Twix",
            "price" => 2,
            "quantity" => 5
        ],
        [
            "name" => "Bounty",
            "price" => 2.5,
            "quantity" => 5
        ]
    ];
    public $cashAmount = 0;
    public $isOn = false;
    public $time;

    public function __construct()
    {

        $this->time = new DateTime();

    }

    //Fonction pour allumer la machine. // Si elle est déjà allumé, l'éteint.
    public function turnOn()
    {
        if ($this->isOn === false) {
            $this->isOn = true;
        }
    }

    public function turnOff()
    {
        $currentTime = new DateTime();

        if ($this->isOn === true && $currentTime->format('H') >= 18) {
            $this->isOn = false;
            return "La machine est éteinte";


        }

        throw new Exception('Vous ne pouvez pas éteindre la machine avant 18h !');

    }

    //SI la machine est allumée, que le snack existe dans la liste :
    //On enlève une quantité
    //+ on ajoute au cashAmount
    public function buySnack($snackName)
    {
        if ($this->isOn === false) {
            throw new Exception("La machine est éteinte");
        }

        if ($this->isOn === true) {
            foreach ($this->snacks as &$snack) {
                if ($snack['name'] == $snackName && $snack['quantity'] > 0) {
                    $snack['quantity']--;
                    $this->cashAmount += $snack['price'];
                    return;
                } else if ($snack['name'] === $snackName && $snack['quantity'] === 0) {
                    throw new Exception("le {$snack['name']} est en rupture de stock'");

                }
            }
        }

    }

    //SI la machine est allumée, fait tomber un snack au hasard + augmente le cashAmount
    public function shootByFoot()
    {
        if ($this->isOn === true) {
            $randomSnackKey = array_rand($this->snacks);
            $randomSnack = $this->snacks[$randomSnackKey];

            if ($this->snacks[$randomSnackKey]['quantity'] > 0) {
                $this->snacks[$randomSnackKey]['quantity']--;

                $randomCashAmount = $randomSnack['price'] + mt_rand(1, 10)/10;
                $randomCashAmount = round($randomCashAmount, 2);
                $this->cashAmount += $randomCashAmount;
            } else {
                throw new Exception("le {$randomSnack['name']} est en rupture de stock'");
            }
        }
    }
}

//Appel des fonctions
$vendorMachine1 = new VendorMachine();
$vendorMachine1->turnOn();
$vendorMachine1->buySnack("Bounty");
$vendorMachine1->buySnack("Snickers");
$vendorMachine1->buySnack("Mars");
$vendorMachine1->shootByFoot();
$vendorMachine1->shootByFoot();
$vendorMachine1->shootByFoot();


var_dump($vendorMachine1);