<?php

namespace App\Services;

use App\Models\Driver;
//use App\Models\User;
class DriverService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getDriverData(){
        return [
            'name' => 'Sevin',
            'role' => 'Developer'
        ];
    }

    public function createDriver(array $data)
    {
        return Driver::create($data);
    }
}
