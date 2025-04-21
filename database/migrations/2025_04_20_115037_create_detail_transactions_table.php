<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transactions_id')->constrained('transactions')->onDelete('cascade');
            $table->foreignId('menus_id')->constrained('menus')->onDelete('cascade');
            $table->enum('portion_size', ['small', 'medium', 'large']);
            $table->integer('quantity');
            $table->double('total');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_transactions');
    }
};
