<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Courses;
use App\Models\Users;

class Enrollments extends Model
{
    use HasFactory;

    const STATUS = [
        "in progress" => 0,
        "complete" => 1
    ];
    
    protected $fillable = ['user_id', 'courses_id', 'status', 'created_at', 'updated_at'];

    public function user() {

        return $this->belongsTo(Users::class, 'user_id');
    }

    public function course()
    {
        return $this->belongsTo(Courses::class, 'courses_id');
    }

    public function getStatusAttribute($value)
    {
        return array_search($value, self::STATUS);
    }

    public function setStatusAttribute($value)
    {
        $this->attributes['status'] = self::STATUS[$value];
    }
}
