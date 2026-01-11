<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends BaseUuid
{
    protected $fillable = [
      'group_id',
      'name',
      'date',
      'end_date',
      'time',
      'end_time',
      'quantity',
      'unit_price',
      'paid',
      'indefinite',
      'period',
    ];

    protected $casts = [
      "paid" => "boolean",
      "indefinite" => "boolean",
      'date' => 'datetime:Y-m-d',
      'end_date' => 'datetime:Y-m-d',
      'time' => 'datetime:H:i:s',
      'end_time' => 'datetime:H:i:s',
      "unit_price"=>"float",
    ];

    /**
     * @autor Adrian Estrada
     * @return BelongsTo
     */
    public function group(): BelongsTo
    {
        return $this->belongsTo(ExpenseGroup::class, 'group_id');
    }
}
