<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'prefecture_id',
        'management_number',
        'description',
        'location',
        'website',
        'logo'
    ];

    public static function generateManagementNumber($prefectureNumber)
    {
        //最新の管理番号を取得
        $latestNumber = self::where('management_number', 'like', $prefectureNumber. '_%')
        ->orderByRaw('CAST(SUBSTRING_INDEX(management_number, "_", -1) AS UNSIGNED) DESC')
        ->value('management_number');

        if($latestNumber) {
            $latestSequence = intval(explode('_', $latestNumber)[1]);
            $newSequence = $latestSequence + 1;
        } else {
            $newSequence = 1;
        }

        return $prefectureNumber . '_' . str_pad($newSequence, 5, '0', STR_PAD_LEFT);
    }

    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function job()
    {
        return $this->hasMany(Job::class);
    }
}
