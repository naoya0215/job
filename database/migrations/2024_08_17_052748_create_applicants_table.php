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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id(); // 応募ID（主キー）
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // 関連するユーザID（外部キー）
            $table->foreignId('job_id')->nullable()->constrained('jobs')->onDelete('set null'); // 関連する求人ID
            $table->enum('sex', ['male', 'female', 'other'])->nullable(); // 性別（男性、女性、その他）
            $table->date('birth_date')->nullable(); // 生年月日
            $table->string('phone_number', 20)->nullable(); // 電話番号
            $table->enum('employment_status', ['employed', 'unemployed', 'student', 'other'])->nullable(); // 就業状況
            $table->text('self_pr')->nullable(); // 自己PR
            $table->enum('status', ['応募なし', '保留中', 'レビュー', '応募済み', '拒否'])->default('応募なし'); // 応募なし　保留中　レビュー　応募済み　拒否
            //学歴
            $table->enum('academic_status', ['graduate', 'university', 'junior', 'technical','high', 'other'])->nullable(); //大学院　大学　短大　高専　高校　その他
            $table->text('schoolname')->nullable(); //学校名 
            $table->string('faculty')->nullable(); //学部
            $table->string('graduation')->nullable(); //卒業年 20XX年　
            $table->string('graduation_month')->nullable(); //卒業月
            //職歴
            $table->integer('jobchange')->nullable(); //転職回数
            $table->string('experienced1')->nullable(); //経験職種
            $table->integer('experienced_years1')->nullable(); //経験年数
            $table->string('experienced_content1')->nullable(); //職務内容1
            $table->string('experienced2')->nullable(); //経験職種
            $table->integer('experienced_years2')->nullable(); //経験年数
            $table->string('experienced_content2')->nullable(); //職務内容2
            $table->string('experienced3')->nullable(); //経験職種
            $table->integer('experienced_years3')->nullable(); //経験年数
            $table->string('experienced_content3')->nullable(); //職務内容3
            $table->timestamps(); // 作成日時、更新日時
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
