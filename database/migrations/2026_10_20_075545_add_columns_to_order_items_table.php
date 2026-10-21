<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->foreignId('order_id')
                ->constrained('orders')
                ->cascadeOnDelete();

            $table->foreignId('menu_item_id')
                ->nullable()
                ->constrained('menu_items')
                ->nullOnDelete();

            $table->string('item_name');
            $table->decimal('price', 10, 2)->default(0);
            $table->unsignedInteger('quantity')->default(1);
            $table->decimal('subtotal', 10, 2)->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->dropForeign(['order_id']);
            $table->dropForeign(['menu_item_id']);

            $table->dropColumn([
                'order_id',
                'menu_item_id',
                'item_name',
                'price',
                'quantity',
                'subtotal',
            ]);
        });
    }
};
