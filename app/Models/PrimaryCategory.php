<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SecondaryCategory;

//第一階層
class PrimaryCategory extends Model
{
    use HasFactory;

    //第二階層カテゴリーは複数のデータを持つ　hasMany
    public function secondary() 
    {
        return $this->hasMany(SecondaryCategory::class);
    }
}
