<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefecture extends Model
{
    use HasFactory;

    protected $fillable = [
        'prefecture_number',
        'prefecture_name'
    ];

    public function companies()
    {
        return $this->hasMany(Company::class);
    }
}
