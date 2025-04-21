<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('detail_transactions', function (Blueprint $table) {
            $table->dropColumn('portion_size'); // hapus dulu
        });

        Schema::table('detail_transactions', function (Blueprint $table) {
            $table->enum('portion_size', ['small', 'medium', 'large'])->after('menus_id');
        });
    }

    public function down(): void
    {
        Schema::table('detail_transactions', function (Blueprint $table) {
            $table->dropColumn('portion_size'); // balikin dulu
        });

        Schema::table('detail_transactions', function (Blueprint $table) {
            $table->string('portion_size')->after('menus_id'); // misal tadinya string
        });
    }
};
