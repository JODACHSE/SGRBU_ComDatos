<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Program extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'program_type_id',
        'name',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the program type that owns the program.
     */
    public function programType()
    {
        return $this->belongsTo(ProgramType::class);
    }

    /**
     * Get the campus programs for the program.
     */
    public function campusPrograms()
    {
        return $this->hasMany(CampusProgram::class);
    }

    /**
     * The campuses that belong to the program.
     */
    public function campuses()
    {
        return $this->belongsToMany(Campus::class, 'campus_program');
    }
}