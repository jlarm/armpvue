<?php

namespace App\Domains\Dealership\DTOs;

class CreateDealershipDTO
{
    public function __construct(
        public string $name,
        public string $address,
        public string $city,
        public string $state,
        public string $phone,
        public int $createdBy,
        public bool $isActive = false,
    ){}

    public function toArray(): array
    {
        return [
          'name' => $this->name,
          'address' => $this->address,
          'city' => $this->city,
          'state' => $this->state,
          'phone' => $this->phone,
          'createdBy' => $this->createdBy,
          'isActive' => $this->isActive,
        ];
    }
}
