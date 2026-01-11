<?php
/**
 * @autor Adrian Estrada
 */

namespace App\Services\Expense;

use App\Models\Expense;
use Illuminate\Support\Facades\Validator;

class UpdateExpenseService
{
    public function __invoke(Expense $expense, array $data): Expense
    {
        $validated = Validator::make($data, [
            'group_id' => 'sometimes|required|uuid|exists:expense_groups,id',
            'name' => 'sometimes|required|string|max:255',
            'date' => 'sometimes|required|date',
            'end_date' => 'nullable|date|after_or_equal:date',
            'time' => 'nullable|date_format:H:i:s',
            'end_time' => 'nullable|date_format:H:i:s',
            'quantity' => 'sometimes|required|integer|min:1',
            'unit_price' => 'sometimes|required|numeric|min:0',
            'paid' => 'sometimes|boolean',
            'indefinite' => 'sometimes|boolean',
            'period' => 'sometimes|required|in:single_payment,weekly,biweekly,monthly,bimonthly,quarterly,semiannually,annually',
        ])->validate();

        $expense->update($validated);
        return $expense->fresh();
    }
}
