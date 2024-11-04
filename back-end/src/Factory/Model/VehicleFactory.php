<?php
// src/Factory/CarFactory.php

namespace App\Factory\Model;

use App\Model\Vehicle;
use App\Model\VehicleBuilder;
use App\Model\CommonVehicle;
use App\Model\LuxuryVehicle;
use Faker\Factory as FakerFactory;
use App\Enum\VehicleTypeEnum;

class VehicleFactory
{
    private $faker;

    public function __construct()
    {
        $this->faker = FakerFactory::create();
    }

    public function createVehicle($type = null, $price = null): Vehicle
    {
        $type =  $type ?? $this->faker->randomElement(VehicleTypeEnum::cases())->value;
        $price = $price ?? $this->faker->randomFloat(2, 1, 1000000);
        $vehicle = VehicleBuilder::createVehicle($type, $price);
        return $vehicle;
    }

    public function createLuxuryVehicle(): LuxuryVehicle
    {
        return new LuxuryVehicle(price: $this->faker->randomFloat(2, 1, 1000000));
    }

    public function createCommonVehicle(): Vehicle
    {
        return new CommonVehicle(price: $this->faker->randomFloat(2, 1, 1000000));
    }
}
