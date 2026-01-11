<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->date('date');
            $table->double('amount')->default(0);
            $table->enum('period', [
                'single_payment',
                'weekly',
                'biweekly',
                'monthly',
                'quarterly',
                'semiannually',
                'annually',
            ])->default('single_payment');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
