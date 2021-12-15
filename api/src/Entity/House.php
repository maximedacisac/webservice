<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use App\Controller\GetHouseName;
use App\Repository\HouseRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


#[ORM\Entity(repositoryClass: HouseRepository::class)]
#[ApiResource(
    collectionOperations: ['get', 'post'],
    itemOperations: ['get', 'put', 'delete',
        'get_name' => [
            'method' => 'GET',
            'path' => '/houses/{id}/name',
            //'normalization_context'=> ['groups' => ['House:read:name']]
            'controller' => GetHouseName::class
    ],
        ],
    denormalizationContext: ['groups' => ['House:write']],
    normalizationContext: ['groups' => ['House:read']],
)]
#[ApiFilter(SearchFilter::class, properties: ['name' => 'partial'])]
#[ApiFilter(DateFilter::class, properties: ['createdDate'])]
#[ApiFilter(BooleanFilter::class, properties: ['available'])]
#[ApiFilter(OrderFilter::class, properties: ['number'])]
class House
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    #[Groups(["House:read", "House:write"])]
    private $number;

    #[ORM\Column(type: 'string', length: 255)]
    //#[Groups(["House:read", "House:write","House:read:name"])]
    #[Groups(["House:read", "House:write"])]
    private $name;

    #[ORM\Column(type: 'datetime')]
    #[Groups("House:write")]
    private $createdDate;

    #[ORM\Column(type: 'boolean')]
    #[Groups(["House:read", "House:write"])]
    private $available;

    private function _construct()
    {
        $this->createdDate = new DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCreatedDate(): ?\DateTimeInterface
    {
        return $this->createdDate;
    }

    public function setCreatedDate(\DateTimeInterface $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    public function getAvailable(): ?bool
    {
        return $this->available;
    }

    public function setAvailable(bool $available): self
    {
        $this->available = $available;

        return $this;
    }
}
