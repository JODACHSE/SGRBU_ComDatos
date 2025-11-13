<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alert extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'loan_id',
        'alert_status',
        'description',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relación con el usuario que reporta la alerta
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con el préstamo asociado
     */
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

    /**
     * Scope para alertas activas
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope para alertas por estado
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('alert_status', $status);
    }
}