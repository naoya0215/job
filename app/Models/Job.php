<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Job extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'title', 'description', 'secondary_category_id', 'location1', 'location2', 'location3',
        'type', 'salary_type', 'min_salary', 'max_salary', 'deadline', 'work_days_min',
        'work_days_max', 'work_hours_start', 'work_hours_end', 'is_active', 'company_id', 'image_path', 'job_number'
    ];

    protected $casts = [
        'deadline' => 'datetime',
    ];

    //管理番号生成
    //(求人登録画面より登録ボタンを押したタイミングで発火)
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($job) {
            $job->job_number = self::generateJobNumber();
        });
    }

    //最新管理番号の取得、成形
    public static function generateJobNumber()
    {
        // 現在の年月を取得 (例: 202408)
        $dateNumber = date('Ym'); 

        // 最新の管理番号を取得
        $latestNumber = self::where('job_number', 'like', $dateNumber . '_%')
            ->orderByRaw('CAST(SUBSTRING_INDEX(job_number, "_", -1) AS UNSIGNED) DESC')
            ->value('job_number');

        if ($latestNumber) {
            $latestSequence = intval(explode('_', $latestNumber)[1]);
            $newSequence = $latestSequence + 1;
        } else {
            $newSequence = 1;
        }

        // 連番を5桁の数字にフォーマット
        $formattedSequence = str_pad($newSequence, 5, '0', STR_PAD_LEFT);

        return $dateNumber . '_' . $formattedSequence;
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function secondaryCategory()
    {
        return $this->belongsTo(SecondaryCategory::class);
    }

    public function applicants()
    {
        return $this->hasMany(Applicant::class);
    }
}