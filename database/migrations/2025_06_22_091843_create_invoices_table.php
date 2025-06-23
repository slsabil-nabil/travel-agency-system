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
    Schema::create('invoices', function (Blueprint $table) {
        $table->id();
        $table->foreignId('agency_id')->constrained()->onDelete('cascade');
        $table->foreignId('booking_id')->nullable()->constrained()->onDelete('set null');
        $table->decimal('amount', 10, 2);
        $table->date('invoice_date');
        $table->string('status')->default('pending');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
