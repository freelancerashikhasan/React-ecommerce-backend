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
        Schema::table('products', function (Blueprint $table) {
            $table->integer('featured_product')->after('status')->default(0);
            $table->integer('today_deals')->after('featured_product')->default(0);
            $table->integer('new_arrival')->after('today_deals')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('featured_product');
            $table->dropColumn('today_deals');
            $table->dropColumn('new_arrival');
        });
    }
};
