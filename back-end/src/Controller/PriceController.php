<?php
namespace App\Controller;
 
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;

use App\Enum\VehicleTypeEnum;
use App\Model\VehicleBuilder;

// Missing API documentation process
class PriceController extends AbstractController
{
    public function index(Request $request, $price, $type): JsonResponse
    {
        $validator = Validation::createValidator();
        $priceConstraint = [
            new Assert\PositiveOrZero(['message' => 'The price must be a positive number, currently ({{ value }}).']),
            new Assert\Type(['type' => 'numeric', 'message' => 'The price must be a numeric value.']),
        ];
        $typeConstraint = new Assert\Choice([
                            'choices' => VehicleTypeEnum::values(), 
                            'message' => 'The value "{{ value }}" you used is not a valid type.',
                        ]);
        $priceViolations = $validator->validate($price, $priceConstraint);
        $typeViolations = $validator->validate($type, $typeConstraint);

        if (count($priceViolations) > 0 || count($typeViolations) > 0) {
            $errors = [];

            foreach ($priceViolations as $violation) {
                $errors['price'][] = $violation->getMessage();
            }

            foreach ($typeViolations as $violation) {
                $errors['type'][] = $violation->getMessage();
            }
            return $this->json(['errors' => $errors], JsonResponse::HTTP_BAD_REQUEST);
        }
        
        $vehicle = VehicleBuilder::createVehicle(type:$type, price:$price);
        $vehicle->setFeesAndTotal();
        $data = [
            'total' => $vehicle->getTotal(),
            'fees' => $vehicle->getFees(),
        ];
        return $this->json($data);
    }
}