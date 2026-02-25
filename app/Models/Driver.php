<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    // Table name (optional if plural correct ah irundha)
    protected $table = 'drivers';

    // Primary key (default id, so optional)
    protected $primaryKey = 'id';

    // Auto increment (default true)
    public $incrementing = true;

    // Primary key type
    protected $keyType = 'int';

    // Mass assignable fields
    protected $fillable = [
        'name',
        'phone',
        'license_number',
        'status'
    ];

    // Hidden fields (API response la show panna vendam na)
    protected $hidden = [
        // example: 'password'
    ];

    // Type casting
    protected $casts = [
        'status' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // Example: Driver belongs to Branch
    /*
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
    */

    /*
    |--------------------------------------------------------------------------
    | Accessors & Mutators
    |--------------------------------------------------------------------------
    */

    // Name automatic uppercase panna example
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst($value);
    }

    /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------
    */

    // Active drivers scope
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}
