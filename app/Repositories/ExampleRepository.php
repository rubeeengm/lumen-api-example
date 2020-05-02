<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IExampleRepository;

class ExampleRepository implements IExampleRepository {
    public function getAll() : Array {
        return ['banana', 'orange', 'pear'];
    }
}