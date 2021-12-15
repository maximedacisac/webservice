<?php

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Entity\House;

final class HouseInputDataTranformer implements DataTransformerInterface
{

    public function transform($object, string $to, array $context = [])
    {
        $house = new House();
        $house->isbn = $object->isbn;

        return $house;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        if ($data instanceof House) {
            return false;
        }

        return House::class === $to && null !== ($context['input']['class'] ?? null);
    }
}
