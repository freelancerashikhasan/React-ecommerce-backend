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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('phone');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('show_password')->nullable();
            $table->tinyInteger('status')->default(Constant::USER_STATUS['deactive']);
            $table->tinyInteger('type')->default(Constant::USER_TYPE['user']);
            $table->string('image')->nullable();
            $table->tinyInteger('gender');
            $table->foreignId('country');
            $table->foreignId('states');
            $table->integer('division_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('upazila_id')->nullable();
            $table->integer('union_id')->nullable();
            $table->integer('otp')->nullable();
            $table->tinyInteger('with_trade_permission')->default(Constant::DATA_APPROVAL_PERMISSION_WITH_LICENSE['no']);
            $table->tinyInteger('without_trade_permission')->default(Constant::DATA_APPROVAL_PERMISSION_WITHOUT_LICENSE['no']);
            $table->tinyInteger('user_approval_per')->default(Constant::USER_APPROVAL_PERMISSION['no']);
            $table->tinyInteger('pharmacy_type')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};


