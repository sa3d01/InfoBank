<?php

namespace Modules\Need\Entities;

use App\Traits\ApiResponseTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory, ApiResponseTrait;

    protected $fillable = [
        'name',
    ];


}
