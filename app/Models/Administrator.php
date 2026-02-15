<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Extend Authenticatable for login capabilities
use Illuminate\Notifications\Notifiable;

class Administrator extends Authenticatable // Extend Authenticatable for login capabilities
{
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     * Explicitly set table name if it's not the plural form of the model name.
     * Laravel would normally assume 'administrators', which matches, so this line is optional but harmless.
     *
     * @var string
     */
    protected $table = 'administrators';

    /**
     * The attributes that are mass assignable.
     * These can be set via `create` or `fill` methods.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'admin_username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     * These won't be returned when converting the model to an array or JSON.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     * Used for type casting attributes to common data types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Define the relationship: An Administrator can manage many Currencies.
     */
    public function currencies()
    {
        return $this->hasMany(Currency::class, 'admin_id');
    }
}
