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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id');
            $table->enum('metode', ['QRIS', 'E-Wallet', 'Debit', 'Kredit']);
            $table->enum('status', ['pending', 'berhasil', 'gagal'])->default('pending');
            $table->decimal('jumlah_bayar', 10, 2);
            $table->timestamp('waktu_bayar')->nullable();
            $table->timestamps();
    
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
