<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanEvidence extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'loan_resource_id',
        'loan_type',
        'photo_path',
        'notes',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the loan resource that owns the loan evidence.
     */
    public function loanResource()
    {
        return $this->belongsTo(LoanResource::class);
    }
}