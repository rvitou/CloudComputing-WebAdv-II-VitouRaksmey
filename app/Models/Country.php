<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Country extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'flag_image_path', 'description', 'main_currency_image_path'];
    public function currencies() // This relationship means "individual notes/coins"
    {
        return $this->hasMany(Currency::class);
    }
}