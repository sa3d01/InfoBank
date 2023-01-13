<?php

namespace Modules\Course\Entities;

use App\Traits\ApiResponseTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory, ApiResponseTrait;

    protected $fillable = [
        'chapter_id',
        'title',
        'description',
        'duration',
        'media_link',
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class, 'chapter_id', 'id');
    }
    public function course(){
        return $this->belongsTo(Course::class, 'course_id');
    }
}
