<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Campus extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'campus_type',
        'department',
        'municipality',
        'address',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the campus programs for the campus.
     */
    public function campusPrograms()
    {
        return $this->hasMany(CampusProgram::class);
    }

    /**
     * Get the resources for the campus.
     */
    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

    /**
     * Get the loans for the campus.
     */
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    /**
     * The programs that belong to the campus.
     */
    public function programs()
    {
        return $this->belongsToMany(Program::class, 'campus_program');
    }
}