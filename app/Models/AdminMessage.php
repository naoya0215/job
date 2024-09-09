<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminMessage extends Model
{
    use HasFactory;

    protected $table = 'adminmessages';

    protected $fillable = [
        'applicant_id',
        'admin_id',
        'content',
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicant::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class, 'applicant_id', 'id')->withDefault();
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'admin_id', 'admin_id')->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'applicant_id', 'id')->withDefault();
    }
}
