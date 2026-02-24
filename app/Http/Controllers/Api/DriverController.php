<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\DriverService;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    protected $driverService;

    // Constructor Injection
    public function __construct(DriverService $driverService)
    {
        $this->driverService = $driverService;
    }
    public function index(){
        $data = $this->driverService->getDriverData();

        return response()->json($data);
    }
}
