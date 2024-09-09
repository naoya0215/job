<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PrimaryCategory;

//SecondaryCategoryは第二階層
class SecondaryCategory extends Model
{
    use HasFactory;
    //PrimaryCategoryは第一階層
    public function Primary() 
    {
        return $this->belongsTo(PrimaryCategory::class);
    }

    public function job()
    {
        return $this->hasMany(Job::class);
    }
}
