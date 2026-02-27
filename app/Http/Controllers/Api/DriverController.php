<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Services\DriverService;
use App\Http\Requests\StoreDriverRequest;
use App\Http\Requests\UpdateDriverRequest;
use App\Models\Driver;

class DriverController extends Controller
{
    protected DriverService $driverService;

    public function __construct(DriverService $driverService)
    {
        $this->driverService = $driverService;
    }
    public function index()
    {
        return $this->driverService->getAllActiveDrivers();
    }

    public function store(StoreDriverRequest $request)
    {
        $driver = $this->driverService->createDriver($request->validated());

        return response()->json([
            'message' => 'Driver created successfully',
            'data' => $driver
        ], 201);
    }

    public function show($id)
    {
        return $this->driverService->getDriverById($id);
    }

    public function update(UpdateDriverRequest $request, Driver $driver)
    {
        $updated = $this->driverService->updateDriver(
            $driver,
            $request->validated()
        );

        return response()->json([
            'message' => 'Driver updated successfully',
            'data' => $updated
        ]);
    }

    public function destroy(Driver $driver)
    {
        $this->driverService->deleteDriver($driver);

        return response()->json([
            'message' => 'Driver deleted successfully'
        ]);
    }

    public function explain()
    {
        return $this->driverService->explainActiveDriversQuery();
    }
}
