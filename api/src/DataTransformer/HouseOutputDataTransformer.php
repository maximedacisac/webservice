<?php

namespace App\DataTransformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use App\Dto\HouseOutput;
use App\Entity\House;

final class HouseOutputDataTransformer implements DataTransformerInterface
{

    public function transform($object, string $to, array $context = [])
    {
        $output = new HouseOutput();
        $output->name = $object->getName();

        return $output;
    }

    public function supportsTransformation($data, string $to, array $context = []): bool
    {
        return HouseOutput::class === $to && $data instanceof House;
    }
}
