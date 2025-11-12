<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'contact_type_id',
        'contact_value',
        'is_principal',
        'is_active',
    ];

    protected $casts = [
        'is_principal' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get the user that owns the contact.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the contact type that owns the contact.
     */
    public function contactType()
    {
        return $this->belongsTo(ContactType::class);
    }
}