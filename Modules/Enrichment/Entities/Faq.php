<?php

namespace Modules\Enrichment\Entities;

use App\Traits\ApiResponseTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory, ApiResponseTrait;

    protected $table = "faqs";

    protected $fillable = [
        'question',
        'answer',
        'banned',
    ];

}
