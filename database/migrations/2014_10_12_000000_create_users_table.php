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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // ユーザーID（主キー）
            $table->string('name'); // ユーザー名
            $table->string('email')->unique(); // メールアドレス（一意）
            $table->timestamp('email_verified_at')->nullable(); // メール確認日時
            $table->string('password'); // パスワード（ハッシュ化）
            $table->enum('role', ['job_seeker', 'company', 'admin'])->default('job_seeker'); // 役割（求職者、企業、管理者）
            $table->text('bio')->nullable(); // 自己紹介
            $table->string('phone')->nullable(); // 電話番号
            $table->rememberToken(); // ログイン状態保持用トークン
            $table->timestamps(); // 作成日時、更新日時
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
