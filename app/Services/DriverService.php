<?php

namespace App\Services;
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
}
