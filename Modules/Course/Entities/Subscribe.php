<?php

namespace Modules\Course\Entities;

use App\Traits\ApiResponseTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    use HasFactory, ApiResponseTrait;

    protected $fillable = [
        'course_id',
        'client_id',
        'status',
    ];


}
