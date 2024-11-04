<?php
namespace App\Model;

use App\Enum\VehicleTypeEnum;
use App\Model\CommonVehicle;
use App\Model\LuxuryVehicle;

/*
* VehicleBuilder class
* 
* This class is responsible for creating a vehicle object based on the type of vehicle.
*/
class VehicleBuilder 
{
    public static function createVehicle($type, $price): Vehicle 
    {
        if ($type === VehicleTypeEnum::Common->value) {
            return new CommonVehicle($price);
        } elseif ($type === VehicleTypeEnum::Luxury->value) {
            return new LuxuryVehicle($price);
        } else {
            throw new \Exception("Invalid Vehicle type: {$type}");
        }
    }
}