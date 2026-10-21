<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('restaurant_table_id')
                ->nullable()
                ->constrained('restaurant_tables')
                ->nullOnDelete();

            $table->string('order_number')->unique();
            $table->string('customer_name')->nullable();
            $table->string('order_type')->default('dine_in');
            $table->string('status')->default('pending');
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('tax', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->string('payment_status')->default('unpaid');
            $table->text('notes')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['restaurant_table_id']);
            $table->dropUnique(['order_number']);

            $table->dropColumn([
                'restaurant_table_id',
                'order_number',
                'customer_name',
                'order_type',
                'status',
                'subtotal',
                'tax',
                'total_amount',
                'payment_status',
                'notes',
            ]);
        });
    }
};
