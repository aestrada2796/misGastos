<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class Income extends BaseUuid
{
    protected $fillable = [
        'name',
        'date',
        'amount',
        'period'
    ];

    protected $casts = [
        'amount' => 'float',
        'date' => 'datetime:Y-m-d',
    ];

    protected static function booted(): void
    {
        static::deleting(function (Income $income) {
            // Eliminar en cascada las distributions relacionadas
            $income->distributions()->each(function ($distribution) {
                $distribution->delete();
            });
        });
    }

    /**
     * @autor Adrian Estrada
     * @return HasMany
     */
    public function distributions(): HasMany
    {
        return $this->hasMany(Distribution::class, 'income_id');
    }
}
