<?php

namespace App\Dtos\Products;

use Spatie\DataTransferObject\DataTransferObject;

class ProductCreateDto extends DataTransferObject {
    public string $sku;
    public string $name;
    public string $description;
    public float $price;
}
