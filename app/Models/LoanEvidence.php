<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class LoanEvidence extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'loan_resource_id',
        'loan_type',
        'photo_path',
        'notes',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relación con LoanResource
    public function loanResource()
    {
        return $this->belongsTo(LoanResource::class);
    }

    // Accessor para la URL de la foto
    public function getPhotoUrlAttribute()
    {
        return $this->photo_path ? Storage::url($this->photo_path) : null;
    }

    // Accessor para el tipo de préstamo formateado
    public function getLoanTypeFormattedAttribute()
    {
        return $this->loan_type === 'prestamo' ? 'Préstamo' : 'Devolución';
    }

    // Scope para activos
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
