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
        Schema::create('companies', function (Blueprint $table) {
            $table->id(); // 企業ID（主キー）
            $table->foreignId('admin_id')->constrained()->onDelete('cascade'); // 関連する管理者ID（外部キー）
            $table->foreignId('prefecture_id')->constrained()->onDelete('cascade'); // 関連する都道府県ID（外部キー）
            $table->string('management_number')->unique()->nullable(); //管理番号
            $table->text('description'); // 企業説明
            $table->string('location'); // 所在地
            $table->string('website')->nullable(); // Webサイト
            $table->string('logo')->nullable(); // ロゴ画像のパス
            $table->timestamps(); // 作成日時、更新日時
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
