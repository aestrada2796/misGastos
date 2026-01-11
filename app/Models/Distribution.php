<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Distribution extends BaseUuid
{
    protected $fillable = [
        'group_id',
        'income_id',
        'percentage',
        'visible',
    ];

    protected $casts = [
        'visible' => 'boolean',
        'percentage' => 'float',
    ];

    /**
     * @autor Adrian Estrada
     * @return BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(ExpenseGroup::class, 'group_id');
    }

    /**
     * @autor Adrian Estrada
     * @return BelongsTo
     */
    public function income(): BelongsTo
    {
        return $this->belongsTo(Income::class, 'income_id');
    }
}
