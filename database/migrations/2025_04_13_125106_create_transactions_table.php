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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->decimal('total_harga', 10, 2);
            $table->enum('tipe', ['dine-in', 'take-away']);
            $table->enum('status', ['menunggu pembayaran', 'diproses', 'selesai', 'dibatalkan'])->default('menunggu pembayaran');
            $table->timestamp('tanggal_transaksi')->useCurrent();
            $table->timestamps();
    
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
