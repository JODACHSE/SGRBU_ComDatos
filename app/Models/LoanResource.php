<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoanResource extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'loan_id',
        'resource_id',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Get the loan that owns the loan resource.
     */
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    /**
     * Get the resource that owns the loan resource.
     */
    public function resource()
    {
        return $this->belongsTo(Resource::class);
    }

    /**
     * Get the loan evidences for the loan resource.
     */
    public function loanEvidences()
    {
        return $this->hasMany(LoanEvidence::class);
    }
}