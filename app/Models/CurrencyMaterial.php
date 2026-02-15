<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot; // Use Pivot base class

class CurrencyMaterial extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'currency_material'; // Explicitly set table name

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'currency_id',
        'material_id',
        'percentage',
    ];

    /**
     * Indicate if the IDs are auto-incrementing.
     * Pivot tables typically do not have a single auto-incrementing primary key.
     *
     * @var bool
     */
    public $incrementing = false; // Primary key is composite, not auto-incrementing by default

    /**
     * Define the relationship: This pivot entry belongs to a Currency.
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    /**
     * Define the relationship: This pivot entry belongs to a Material.
     */
    public function material()
    {
        return $this->belongsTo(Material::class);
    }
}
