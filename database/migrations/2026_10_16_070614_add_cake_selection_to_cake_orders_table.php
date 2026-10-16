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
        Schema::table('cake_orders', function (Blueprint $table) {
             $table->foreignId('cake_id')
            ->nullable()
            ->constrained('cakes')
            ->nullOnDelete();

        $table->string('cake_name', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cake_orders', function (Blueprint $table) {
              $table->dropConstrainedForeignId('cake_id');
        $table->dropColumn('cake_name');
        });
    }
};
