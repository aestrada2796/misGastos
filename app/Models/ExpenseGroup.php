<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class ExpenseGroup extends BaseUuid
{
    protected $fillable = [
        'name',
        'color',
    ];

    protected static function booted(): void
    {
        static::deleting(function (ExpenseGroup $expenseGroup) {
            // Eliminar en cascada los expenses relacionados
            $expenseGroup->expenses()->each(function ($expense) {
                $expense->delete();
            });

            // Eliminar en cascada las distributions relacionadas
            $expenseGroup->distributions()->each(function ($distribution) {
                $distribution->delete();
            });
        });
    }

    /**
     * @autor Adrian Estrada
     * @return HasMany
     */
    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class, 'group_id');
    }

    /**
     * @autor Adrian Estrada
     * @return HasMany
     */
    public function distributions(): HasMany
    {
        return $this->hasMany(Distribution::class, 'group_id');
    }
}
