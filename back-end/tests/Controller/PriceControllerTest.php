<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

use App\Enum\VehicleTypeEnum;



class PriceControllerTest extends WebTestCase
{
    public function testIndexWithValidCommonVehicle()
    {
        $client = static::createClient();
        $client->request('GET', '/api/price/1000/' . VehicleTypeEnum::Common->value);

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $responseData = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('total', $responseData);
        $this->assertArrayHasKey('fees', $responseData);
    }

    public function testIndexWithValidLuxuryVehicle()
    {
        $client = static::createClient();
        $client->request('GET', '/api/price/5000/' . VehicleTypeEnum::Luxury->value);

        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());
        $responseData = json_decode($client->getResponse()->getContent(), true);
        $this->assertArrayHasKey('total', $responseData);
        $this->assertArrayHasKey('fees', $responseData);
    }

    public function testIndexWithInvalidPrice()
    {
        $client = static::createClient();
        $client->request('GET', '/api/price/invalid/' . VehicleTypeEnum::Common->value);

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $client->getResponse()->getStatusCode());
    }

    public function testIndexWithInvalidVehicleType()
    {
        $client = static::createClient();
        $client->request('GET', '/api/price/1000/invalid');

        $this->assertEquals(Response::HTTP_BAD_REQUEST, $client->getResponse()->getStatusCode());
    }
}