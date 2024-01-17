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
        Schema::create('create_payment', function (Blueprint $table) {
            $table->id();
            $table->integer('p_tranaction_id')->nullale();
            $table->integer('p_user_id')->nullale();
            $table->float('p_money')->nullale()->comment('Số tiền thanh toán');
            $table->string('p_note')->nullale()->comment('Nội dung thanh toán');
            $table->string('p_vnp_response_code',255)->nullale()->comment('Mã phản hồi');
            $table->string('p_code_vnpay',255)->nullale()->comment('Mã giao dịch');
            $table->string('p_code_bank',255)->nullale()->comment('Mã ngân hàng');
            $table->dateTime('p_time')->nullale()->comment('Thời gian chuyển khoản');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('create_payment');
    }
};
