<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // SAFE UP
    public function up(): void
    {
        if (!Schema::hasTable('drivers')) {

            Schema::create('drivers', function (Blueprint $table) {

                // Primary Key
                $table->bigIncrements('id'); // PK auto increment

                $table->string('name');
                $table->string('phone', 15);
                $table->string('license_number');
                $table->boolean('status')->default(1);

                $table->timestamps();

                // Index
                $table->index('name', 'idx_drivers_name');
                $table->index('phone', 'idx_drivers_phone');

                // Unique Index
                $table->unique('license_number', 'uq_drivers_license');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    // SAFE DOWN
    public function down(): void
    {
        if (Schema::hasTable('drivers')) {
            Schema::dropIfExists('drivers');
        }
    }
    
};
