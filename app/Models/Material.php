<?php

        namespace App\Models;

        use Illuminate\Database\Eloquent\Factories\HasFactory;
        use Illuminate\Database\Eloquent\Model;

        class Material extends Model
        {
            use HasFactory; // Recommended for factory support

            /**
             * The attributes that are mass assignable.
             *
             * @var array<int, string>
             */
            protected $fillable = [
                'name', // e.g., 'Paper', 'Polymer', 'Steel', 'Bi-Metallic'
                'description', // optional
            ];

            /**
             * Define the relationship: A Material can be used in many Currencies (notes/coins).
             * This is the inverse of the relationship in the Currency model.
             */
            public function currencies()
            {
                return $this->belongsToMany(Currency::class, 'currency_material')
                            ->withPivot('percentage')
                            ->withTimestamps();
            }
        }
        