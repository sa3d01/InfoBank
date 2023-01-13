<?php

namespace Modules\Course\Entities;

use App\Traits\ApiResponseTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory, ApiResponseTrait;

    protected $fillable = [
        'course_id',
        'title'
    ];

    public function sessions()
    {
        return $this->hasMany(Session::class, 'chapter_id', 'id');
    }
    public function course(){
        return $this->belongsTo(Course::class, 'course_id');
    }

}
