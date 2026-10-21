<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('restaurant_tables', function (Blueprint $table) {
            $table->string('table_number')->unique();
            $table->unsignedInteger('capacity')->default(4);
            $table->string('status')->default('available');
            $table->text('description')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('restaurant_tables', function (Blueprint $table) {
            $table->dropUnique(['table_number']);
            $table->dropColumn([
                'table_number',
                'capacity',
                'status',
                'description',
            ]);
        });
    }
};
