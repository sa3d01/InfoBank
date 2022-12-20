<?php

namespace Modules\Need\Entities;

use App\Traits\ApiResponseTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Need extends Model
{
    use HasFactory, ApiResponseTrait;

    protected $fillable = [
        'client_id',
        'client_name',
        'client_phone',
        'place_id',
        'training_id',
        'title_training_id',
        'status',
        'news'
    ];
    protected $casts=[
        'news'=>'json'
    ];
    public function place(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Place::class, 'place_id', 'id');
    }
    public function training(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Training::class, 'training_id', 'id');
    }
    public function title_training(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Training::class, 'title_training_id', 'id');
    }


}
