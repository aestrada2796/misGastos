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
        Schema::create('expenses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('group_id');
            $table->string('name');
            $table->date('date');
            $table->date('end_date')->nullable();
            $table->time('time')->nullable();
            $table->date('end_time')->nullable();
            $table->integer('quantity')->default(1);
            $table->double('unit_price')->default(0);
            $table->boolean('paid')->default(false);
            $table->boolean('indefinite')->default(false);
            $table->enum('period', [
                'single_payment',
                'weekly',
                'biweekly',
                'monthly',
                'bimonthly',
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
        Schema::dropIfExists('expenses');
    }
};
