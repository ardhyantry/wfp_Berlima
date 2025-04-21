<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->double('subtotal');
            $table->double('discount')->default(0);
            $table->double('total');
            $table->enum('order_type', ['dine_in', 'take_away']);
            $table->enum('payment_type', ['QRIS', 'credit_card', 'debit_card', 'e_wallet']);
            $table->foreignId('users_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
