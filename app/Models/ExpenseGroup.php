<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class ExpenseGroup extends BaseUuid
{
    protected $fillable = [
        'name',
        'color',
    ];

    /**
     * @autor Adrian Estrada
     * @return HasMany
     */
    public function expenses(): HasMany
    {
        return $this->hasMany(ExpenseGroup::class, 'group_id');
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
