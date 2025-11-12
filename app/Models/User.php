<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'second_name',
        'lastname',
        'second_lastname',
        'document_type_id',
        'identification_number',
        'gender_id',
        'emergency_contact_name',
        'emergency_contact_phone',
        'role',
        'campus_program_id',
        'academic_status',
        'student_code',
        'is_active',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_active' => 'boolean',
    ];

    /**
     * Get the document type associated with the user.
     */
    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }

    /**
     * Get the gender associated with the user.
     */
    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    /**
     * Get the campus program associated with the user.
     */
    public function campusProgram()
    {
        return $this->belongsTo(CampusProgram::class);
    }

    /**
     * Get the contacts for the user.
     */
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    /**
     * Get the loans for the user.
     */
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    /**
     * Determine if the user has the 'admin' role.
     *
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Determine if the user has the 'staff' role.
     *
     * @return bool
     */
    public function isStaff()
    {
        return $this->role === 'staff';
    }

    /**
     * Determine if the user has the 'estudiante' role (Student).
     *
     * @return bool
     */
    public function isStudent()
    {
        return $this->role === 'estudiante';
    }

    /**
     * Determine if the user has the 'profesor' role (Professor).
     *
     * @return bool
     */
    public function isProfessor()
    {
        return $this->role === 'profesor';
    }
}
