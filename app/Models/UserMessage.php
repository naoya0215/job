<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMessage extends Model
{
    use HasFactory;

    protected $table = 'usermessages';

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    //関連する求人にアクセス可能
    public function job()
    {
        return $this->belongsTo(Job::class, 'applicant_id', 'id');
    }
}
