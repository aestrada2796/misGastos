<?php
/**
 * @autor Adrian Estrada
 */

namespace App\Services\Expense;

use App\Models\Expense;
use Illuminate\Support\Facades\Validator;

class CreateExpenseService
{
    public function __invoke(array $data): Expense
    {
        $validated = Validator::make($data, [
            'group_id' => 'required|uuid|exists:expense_groups,id',
            'name' => 'required|string|max:255',
            'date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:date',
            'time' => 'nullable|date_format:H:i:s',
            'end_time' => 'nullable|date_format:H:i:s',
            'quantity' => 'required|integer|min:1',
            'unit_price' => 'required|numeric|min:0',
            'paid' => 'boolean',
            'indefinite' => 'boolean',
            'period' => 'required|in:single_payment,weekly,biweekly,monthly,bimonthly,quarterly,semiannually,annually',
        ])->validate();

        return Expense::create($validated);
    }
}
