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
        Schema::table('comapany_infos', function (Blueprint $table) {
            $table->decimal('min_withdraw', 10,2)->default(0)->after('meta_image');
            $table->decimal('max_withdraw', 10,2)->nullable()->after('min_withdraw');
            $table->decimal('min_deposit', 10,2)->default(0)->after('max_withdraw');
            $table->decimal('max_deposit', 10,2)->nullable()->after('min_deposit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comapany_infos', function (Blueprint $table) {
            $table->dropColumn('min_withdraw');
            $table->dropColumn('max_withdraw');
            $table->dropColumn('min_deposit');
            $table->dropColumn('max_deposit');
        });
    }
};
