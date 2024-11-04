<?php
namespace App\Model;

class LuxuryVehicle extends Vehicle 
{
    const BASIC_FEES_MAX = 200;
    const BASIC_FEES_MIN = 25;
    const SPECIAL_FEES_PERCENTAGE = 4;

    public function __construct($price) 
    {
        parent::__construct($price);
        $this->basic_fees_max = self::BASIC_FEES_MAX;
        $this->basic_fees_min = self::BASIC_FEES_MIN;
        $this->special_fees_percentage = self::SPECIAL_FEES_PERCENTAGE;
    }
}