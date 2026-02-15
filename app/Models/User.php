<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'user_fullname',
        'user_nickname',
        'email',
        'password',
        'email_verified_at',
        'country', // ADDED
        'gender',  // ADDED
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function downloadLogs()
    {
        return $this->hasMany(DownloadLog::class, 'user_id');
    }

    // You might also add a relationship to Currency if users collect specific notes
    // For counting 'denominator currency in hand' and 'currency countries'
    // This assumes a pivot table like 'user_currencies' or 'collections'
    public function collectedCurrencies()
    {
        // Assuming a many-to-many relationship through a pivot table like 'collections'
        // where 'collections' table has 'user_id' and 'currency_id'
        return $this->belongsToMany(Currency::class, 'collections', 'user_id', 'currency_id');
    }
}
