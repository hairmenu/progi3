<?php

namespace App\Model;

abstract class Vehicle
{
    protected $price;
    protected $fees = [
        'basic' =>  null,
        'special' => null,
        'association' => null,
        'storage' => null,
    ];
    public $basic_fees_max;
    public $basic_fees_min;
    public $basic_fees_percentage = 10;
    public $special_fees_percentage;
    public $storage_fees = 100;
    protected $total = 0;

    public function __construct($price)
    {
        $this->price = $price;
    }

    public function calculateBasicFees(): float
    {
        return round($this->basic_fees_percentage / 100 * $this->price,2);
    }

    public function setBasicFees(): void
    {
        // make sure we keep the min valeu between the basic_fees_min and the basic_fees_max to cap the max amount
        $basic_fees =  min($this->basic_fees_max, $this->calculateBasicFees());
        // make sure we dont go under min fees
        $basic_fees = max($this->basic_fees_min, $basic_fees);
        $this->fees['basic'] = $basic_fees;
    }

    public function setSpecialFees(): void
    {
        $this->fees['special'] = round($this->price * $this->special_fees_percentage / 100, 2);
    }
    
    public function setAssociationFees(): void
    {
        // Spec does not specify if price is under 1, assuming 0
        $assos_fees = 0;
        if ($this->price >=1 && $this->price <= 500) {
            $assos_fees = 5;
        } elseif ($this->price > 500 && $this->price <= 1000) {
            $assos_fees = 10;
        } elseif ($this->price > 1000 && $this->price <= 3000) {
            $assos_fees = 15;
        } elseif ($this->price > 3000) { //over 3000
            $assos_fees = 20;
        }
        $this->fees['association'] = $assos_fees;
    }
    
    public function setStorageFees(): void
    {
        $this->fees['storage'] = $this->storage_fees;
    }

    public function setFeesAndTotal(): void
    {
        $this->setFees();
        $this->total = round($this->price + array_sum($this->fees), 2);
    }

    public function setFees(): void
    {
        $this->setBasicFees();
        $this->setSpecialFees();
        $this->setAssociationFees();
        $this->setStorageFees();
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function getFees(): array
    {
        return $this->fees;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
