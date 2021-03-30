<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageordersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packageorders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('sale_id')->nullable()->constrained('sales')->onDelete('set null');
            $table->foreignId('package_id')->nullable()->constrained('packages')->onDelete('set null');
            $table->foreignId('plan_id')->constrained('plans');
            $table->integer('status')->nullable();
            $table->double('package_cost')->nullable();
            $table->string('method')->nullable();
            $table->string('currency_sign')->nullable();
            $table->string('currency_code')->nullable();
            $table->string('currency_value')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('attendance_id')->nullable();
            $table->string('txn_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packageorders');
    }
}
