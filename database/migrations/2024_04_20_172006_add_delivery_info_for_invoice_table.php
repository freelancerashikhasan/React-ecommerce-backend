<?php

use App\Helpers\Constant;
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
        Schema::table('invoices', function (Blueprint $table) {
            $table->string('name')->nullable()->after('cookie_id');
            $table->string('phone')->nullable()->after('name');
            $table->string('address')->nullable()->after('phone');
            $table->tinyInteger('payment_method')->default(Constant::PAYMENT_METHOD['cod'])->after('address');
            $table->tinyInteger('payment_status')->default(Constant::PAYMENT_STATUS['unpaid'])->after('order_status');

        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('payment_method');
            $table->dropColumn('payment_status');
        });
    }
};
