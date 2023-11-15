<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_number');
            $table->date('invoices_date');
            $table->date('due_time');
            $table->string('product');
            $table->integer('bill_amount');
            $table->integer('commission');
            $table->string('section');
            $table->string('discount');
            $table->string('tax_percent');
            $table->decimal('tax_value');
            $table->decimal('total');
            $table->decimal('restToPay')->default(0);
            $table->decimal('paid')->default(0);
            $table->string('status')->default('Not paid');
            $table->integer('value_status')->default(0);
            $table->text('note')->nullable();
            $table->string('user');
            $table->softDeletes();
            $table->timestamps();
            /*
             *
             */
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
