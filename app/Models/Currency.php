<?php
    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Currency extends Model
    {
        use HasFactory;

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'country_id',
            'type', // e.g., 'Banknote', 'Coin'
            'denomination',
            'issue_date',
            'is_active',
            'deactivated_start_date',
            'deactivated_end_date',
            'front_image_path',
            'back_image_path',
            'description', // This description is for the individual note/coin
            'version',
            'series',
            'download_count',
            'view_count',
            'admin_id',
        ];

        /**
         * The attributes that should be cast.
         *
         * @var array<string, string>
         */
        protected $casts = [
            'issue_date' => 'date',
            'deactivated_start_date' => 'date',
            'deactivated_end_date' => 'date',
            'is_active' => 'boolean',
        ];

        /**
         * Define the relationship: A Currency (note/coin) belongs to one Country.
         */
        public function country()
        {
            return $this->belongsTo(Country::class, 'country_id');
        }

        /**
         * Define the relationship: A Currency (note/coin) can have many Materials.
         * This is a many-to-many relationship through the 'currency_material' pivot table.
         */
        public function materials()
        {
            return $this->belongsToMany(Material::class, 'currency_material')
                        ->withPivot('percentage')
                        ->withTimestamps();
        }

        /**
         * Define the relationship: A Currency (note/coin) can have many DownloadLogs.
         */
        public function downloadLogs()
        {
            return $this->hasMany(DownloadLog::class, 'currency_id');
        }

        /**
         * Define the relationship: A Currency (note/coin) belongs to an Administrator.
         */
        public function admin()
        {
            return $this->belongsTo(Administrator::class, 'admin_id');
        }
    }
    