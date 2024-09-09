<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sex',
        'birth_date',
        'phone_number',
        'employment_status'
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function adminmessages()
    {
        return $this->hasMany(AdminMessage::class);
    }

    public function usermessages()
    {
        return $this->hasMany(UserMessage::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'job_id', 'id');
    }
}