<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loan extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'campus_id',
        'loan_date',
        'expected_return_date',
        'actual_return_date',
        'loan_status',
        'notes',
        'is_active',
    ];

    protected $casts = [
        'loan_date' => 'datetime',
        'expected_return_date' => 'datetime',
        'actual_return_date' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Get the user that owns the loan.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the campus that owns the loan.
     */
    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    /**
     * Get the loan resources for the loan.
     */
    public function loanResources()
    {
        return $this->hasMany(LoanResource::class);
    }

    /**
     * Get the alerts for the loan.
     */
    public function alerts()
    {
        return $this->hasMany(Alert::class);
    }
}
