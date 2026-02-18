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
            $table->bigIncrements('id');
            $table->dateTime('date_time');
            $table->foreignId('item_id')->constrained()->cascadeOnDelete();
            $table->double('qty_in')->default(0);
            $table->double('qty_out')->default(0);
            $table->string('reference_type');   
            $table->unsignedBigInteger('reference_id');
            $table->foreignId('inventory_id')->nullable()->constrained()->nullOnDelete();
            $table->text('remark')->nullable();
            $table->timestamps();
            $table->index(['item_id', 'inventory_id']);
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