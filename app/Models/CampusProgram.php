<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CampusProgram extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'campus_program';

    protected $fillable = [
        'campus_id',
        'program_id',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the campus that owns the campus program.
     */
    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    /**
     * Get the program that owns the campus program.
     */
    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    /**
     * Get the users for the campus program.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}