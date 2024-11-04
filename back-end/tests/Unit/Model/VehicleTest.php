<?php
namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Faker\Factory as FakerFactory;

use App\Model\Vehicle;
use App\Factory\Model\VehicleFactory;
use App\Model\CommonVehicle;
use App\Model\LuxuryVehicle;


class VehicleTest extends TestCase 
{
    
    private $vehicleFactory;
    private $faker;

    protected function setUp(): void 
    {
        $this->vehicleFactory = new VehicleFactory();
        $this->faker = FakerFactory::create();
    }


    public function testSetBasicFees() 
    {
        $vehicle = $this->vehicleFactory->createVehicle();
        $vehicle->setBasicFees();
        $this->assertGreaterThan(0, $vehicle->getFees()['basic']);
    }

    private function _get_mocked_calculateBasicFees_vehicle_($class,$price, $returnedPrice) 
    {
        $vehicle = $this->getMockBuilder($class)
                ->setConstructorArgs([$price])
                ->onlyMethods(['calculateBasicFees'])
                ->getMock();
        $vehicle->method('calculateBasicFees')
            ->willReturn($returnedPrice);
        return $vehicle;
    }

    public function testSetBasicFeesValueForCommon() 
    {
        // Test that basic fees are smaller than the max by mocking the calculateBasicFees to be under max
        $price = $this->faker->randomFloat(2, 1, 1000000);
        $underMaxPriced = CommonVehicle::BASIC_FEES_MAX - $this->faker->randomFloat(2, 1, CommonVehicle::BASIC_FEES_MAX);
        $vehicle = $this->_get_mocked_calculateBasicFees_vehicle_(CommonVehicle::class,$price, $underMaxPriced);
        $vehicle->setBasicFees();
        $this->assertGreaterThan($vehicle->getFees()['basic'], $vehicle->basic_fees_max);
    }

    public function testSetBasicFeesValueForLuxury() 
    {
        // Test that basic fees are smaller than the max by mocking the calculateBasicFees to be under max
        $price = $this->faker->randomFloat(2, 1, 1000000);
        $underMaxPriced = LuxuryVehicle::BASIC_FEES_MAX - $this->faker->randomFloat(2, 1, LuxuryVehicle::BASIC_FEES_MAX);
        $vehicle = $this->_get_mocked_calculateBasicFees_vehicle_(LuxuryVehicle::class,$price, $underMaxPriced);
        $vehicle->setBasicFees();
        $this->assertGreaterThan($vehicle->getFees()['basic'], $vehicle->basic_fees_max);
    }

    public function testSetBasicFeesMaxValueForCommon() 
    {
        $price = $this->faker->randomFloat(2, 1, 1000000);
        $overPriced = $price + $this->faker->randomFloat(2, 1, 100);
        $vehicle = $this->_get_mocked_calculateBasicFees_vehicle_(CommonVehicle::class,$price, $overPriced);
        $vehicle->setBasicFees();
        $this->assertEquals($vehicle->basic_fees_max, $vehicle->getFees()['basic']);
    }

    public function testSetBasicFeesMaxValueForLuxury() 
    {
        $price = $this->faker->randomFloat(2, 1, 1000000);
        $overPriced = $price + $this->faker->randomFloat(2, 1, 100);
        $vehicle = $this->_get_mocked_calculateBasicFees_vehicle_(LuxuryVehicle::class,$price, $overPriced);
        $vehicle->setBasicFees();
        $this->assertEquals($vehicle->basic_fees_max, $vehicle->getFees()['basic']);
    }

    public function testSetBasicFeesMinValueForCommon() 
    {
        $price = $this->faker->randomFloat(2, 1, 1000000);
        $underMinPriced = CommonVehicle::BASIC_FEES_MIN - $this->faker->randomFloat(2, 0.5, CommonVehicle::BASIC_FEES_MIN -1);
        $vehicle = $this->_get_mocked_calculateBasicFees_vehicle_(CommonVehicle::class,$price, $underMinPriced);
        $vehicle->setBasicFees();
        $this->assertEquals($vehicle->basic_fees_min, $vehicle->getFees()['basic']);
    }

    public function testSetBasicFeesMinValueForLuxury() 
    {
        $price = $this->faker->randomFloat(2, 1, 1000000);
        $underMinPriced = LuxuryVehicle::BASIC_FEES_MIN - $this->faker->randomFloat(2, 0.5, LuxuryVehicle::BASIC_FEES_MIN -1);
        $vehicle = $this->_get_mocked_calculateBasicFees_vehicle_(LuxuryVehicle::class,$price, $underMinPriced);
        $vehicle->setBasicFees();
        $this->assertEquals($vehicle->basic_fees_min, $vehicle->getFees()['basic']);
    }

    public function testSetSpecialFeesIsSet() 
    {
        $vehicle = $this->vehicleFactory->createVehicle();
        $vehicle->setSpecialFees();
        $this->assertGreaterThan(0, $vehicle->getFees()['special']);
    }

    public function testSetSpecialFeesIsSmallerThanFullPrice() 
    {
        $vehicle = $this->vehicleFactory->createVehicle();
        $vehicle->setSpecialFees();
        $this->assertGreaterThan($vehicle->getFees()['special'], $vehicle->getPrice());
    }

    public function testSetAssociationFeesForVeryLowPrice() 
    {
        $price = $this->faker->randomFloat(2, 0, 1);
        $vehicle = $this->vehicleFactory->createVehicle(price:$price);
        $vehicle->setAssociationFees();
        $this->assertEquals(0, $vehicle->getFees()['association']);
    }

    public function testSetAssociationFeesForLowPrice() 
    {
        $price = $this->faker->randomFloat(2, 1, 500);
        $vehicle = $this->vehicleFactory->createVehicle(price:$price);
        $vehicle->setAssociationFees();
        $this->assertEquals(5, $vehicle->getFees()['association']);
    }
    
    public function testSetAssociationFeesForMediumPrice() 
    {
        $price = $this->faker->randomFloat(2, 501, 1000);
        $vehicle = $this->vehicleFactory->createVehicle(price:$price);
        $vehicle->setAssociationFees();
        $this->assertEquals(10, $vehicle->getFees()['association']);
    }
    
    public function testSetAssociationFeesForHighPrice() 
    {
        $price = $this->faker->randomFloat(2, 1001, 3000);
        $vehicle = $this->vehicleFactory->createVehicle(price:$price);
        $vehicle->setAssociationFees();
        $this->assertEquals(15, $vehicle->getFees()['association']);
    }
    
    public function testSetAssociationFeesForEndPrice() 
    {
        $price = $this->faker->randomFloat(2, 3001, 1000000);
        $vehicle = $this->vehicleFactory->createVehicle(price:$price);
        $vehicle->setAssociationFees();
        $this->assertEquals(20, $vehicle->getFees()['association']);
    }


    public function testSetStorageFees() 
    {
        $vehicle = $this->vehicleFactory->createVehicle();
        $vehicle->setStorageFees();
        $this->assertEquals($vehicle->storage_fees, $vehicle->getFees()['storage']);
    }

    public function testGetFees() 
    {
        $vehicle = $this->vehicleFactory->createVehicle();
        $vehicle->setFees();
        $fees = $vehicle->getFees();
        $this->assertNotNull($fees['basic']);
        $this->assertNotNull($fees['special']);
        $this->assertNotNull($fees['association']);
        $this->assertNotNull($fees['storage']);
    }

    public function testSetFeesAndTotal() 
    {
        $vehicle = $this->vehicleFactory->createVehicle();
        $vehicle->setFeesAndTotal();
        $this->assertGreaterThan(0, $vehicle->getTotal());
    }

}