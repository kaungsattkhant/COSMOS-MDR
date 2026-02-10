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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->string('po_no')->unique();
            $table->string('po_invoice_no')->unique()->nullable();
            $table->dateTime('po_date')->defaultNow();
            $table->foreignId('supplier_id')->constrained('suppliers')->cascadeOnDelete();
            $table->double('total_amount')->default(0);
            $table->double('paid_amount')->default(0);
            $table->string('status')->default('received'); // e.g., received, pending, ordered
            $table->text('remark')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};