<?php

namespace App\Controller;

use App\Entity\House;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class GetHouseName extends AbstractController
{


    public function __invoke(House $data): string
    {
        return $data->getName();
    }
}
