<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resource extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'campus_id',
        'resource_type_id',
        'resource_status_id',
        'name',
        'resource_code',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the campus that owns the resource.
     */
    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    /**
     * Get the resource type that owns the resource.
     */
    public function resourceType()
    {
        return $this->belongsTo(ResourceType::class);
    }

    /**
     * Get the resource status that owns the resource.
     */
    public function resourceStatus()
    {
        return $this->belongsTo(ResourceStatus::class);
    }

    /**
     * Get the loan resources for the resource.
     */
    public function loanResources()
    {
        return $this->hasMany(LoanResource::class);
    }
}