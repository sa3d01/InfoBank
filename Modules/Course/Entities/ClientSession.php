<?php

namespace Modules\Course\Entities;

use App\Traits\ApiResponseTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientSession extends Model
{
    use HasFactory, ApiResponseTrait;

    protected $table="client_sessions";
    protected $fillable = [
        'session_id',
        'client_id',
    ];


}
