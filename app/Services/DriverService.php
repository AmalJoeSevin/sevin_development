<?php

namespace App\Services;

use App\Models\Driver;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class DriverService
{
    /*
    |--------------------------------------------------------------------------
    | List Drivers (Indexed Query)
    |--------------------------------------------------------------------------
    */
    public function getAllActiveDrivers(int $perPage = 10)
    {
        try {
            return Driver::where('status', 1)
                ->orderByDesc('created_at')
                ->paginate($perPage);
        } catch (Exception $e) {

            Log::error('Driver Fetch Error: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Unable to fetch drivers'
            ], 500);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Create Driver
    |--------------------------------------------------------------------------
    */
    public function createDriver(array $data)
    {
        try {

            $driver = DB::transaction(function () use ($data) {

                $driver = Driver::create($data);

                // Example: additional table operation
                // DB::table('audit_logs')->insert([
                //     'message' => 'Driver Created ID: '.$driver->id
                // ]);

                return $driver;
            });

            return response()->json([
                'status' => true,
                'message' => 'Driver created successfully',
                'data' => $driver
            ], 201);

        } catch (Exception $e) {

            Log::error('Driver Store Error: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Transaction Failed'
            ], 500);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Get Single Driver
    |--------------------------------------------------------------------------
    */
    public function getDriverById(int $id)
    {
        return Driver::findOrFail($id);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Driver
    |--------------------------------------------------------------------------
    */
    public function updateDriver($id, array $data)
    {
        try {

            $driver = DB::transaction(function () use ($id, $data) {

                $driver = Driver::findOrFail($id);
                $driver->update($data);

                return $driver;
            });

            return response()->json([
                'status' => true,
                'message' => 'Driver updated successfully',
                'data' => $driver
            ]);

        } catch (Exception $e) {

            Log::error('Driver Update Error: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Update Failed'
            ], 500);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Delete Driver
    |--------------------------------------------------------------------------
    */
    public function deleteDriver($id)
    {
        try {

            DB::transaction(function () use ($id) {

                $driver = Driver::findOrFail($id);
                $driver->delete();
            });

            return response()->json([
                'status' => true,
                'message' => 'Driver deleted successfully'
            ]);

        } catch (Exception $e) {

            Log::error('Driver Delete Error: '.$e->getMessage());

            return response()->json([
                'status' => false,
                'message' => 'Delete Failed'
            ], 500);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Search Driver by Phone (Indexed Column)
    |--------------------------------------------------------------------------
    */
    public function findByPhone(string $phone)
    {
        return Driver::where('phone', $phone)->first();
    }

    /*
    |--------------------------------------------------------------------------
    | EXPLAIN Query (Performance Debug)
    |--------------------------------------------------------------------------
    */
    public function explainActiveDriversQuery()
    {
        $query = Driver::where('status', 1)
            ->orderByDesc('created_at');

        return DB::select(
            "EXPLAIN " . $query->toSql(),
            $query->getBindings()
        );
    }
}