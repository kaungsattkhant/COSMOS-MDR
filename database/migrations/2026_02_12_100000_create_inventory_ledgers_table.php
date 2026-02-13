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
        Schema::create('inventory_ledgers', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date_time');
            $table->foreignId('inventory_id')->constrained('inventories')->cascadeOnDelete();
            $table->string('transaction_type'); // e.g., GRN, Sale, Adjustment, Transfer
            $table->unsignedBigInteger('transaction_id')->nullable(); // ID of the related transaction (polymorphic or direct ID)
            $table->string('reference_no')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_ledgers');
    }
};