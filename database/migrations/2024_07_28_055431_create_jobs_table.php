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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id(); // 求人ID（主キー）
            $table->foreignId('company_id')->constrained()->onDelete('cascade'); // 関連する企業ID（外部キー）
            $table->foreignId('secondary_category_id')->constrained(); // 関連するカテゴリID（外部キー）
            $table->string('job_number')->unique()->nullable(); //管理番号
            $table->string('title'); // 求人タイトル
            $table->text('description'); // 求人詳細
            $table->string('salary_type'); // 時給、日給、月給
            $table->integer('min_salary'); //最低賃金
            $table->integer('max_salary'); //最高賃金
            $table->string('type');
            $table->string('location1'); // 勤務地1
            $table->string('location2')->nullable(); // 勤務地2
            $table->string('location3')->nullable(); // 勤務地3
            $table->date('deadline'); // 応募締切日
            $table->integer('work_days_min')->nullable(); //最低出勤日数
            $table->integer('work_days_max')->nullable(); //最高出勤日数
            $table->time('work_hours_start')->nullable(); //勤務開始時間
            $table->time('work_hours_end')->nullable(); //勤務終了時間
            $table->string('image_path')->nullable(); //求人画像
            $table->boolean('is_active')->default(true); // 求人の有効/無効状態
            $table->timestamps(); // 作成日時、更新日時
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
