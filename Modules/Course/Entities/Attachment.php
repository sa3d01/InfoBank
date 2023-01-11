<?php

namespace Modules\Course\Entities;

use App\Traits\ApiResponseTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Attachment extends Model implements HasMedia
{
    use HasFactory, ApiResponseTrait,InteractsWithMedia;

    protected $fillable = [
        'course_id',
        'title',
        'type',
        'file',
    ];
    public function registerMediaConversions($media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }

    protected function getFileAttribute()
    {
        $file = $this->getMedia("Attachment")->first();
        if ($file) {
            return url("media/" . $file->id . "/" . $file->file_name);
        }
        return "";
    }

    protected function setFileAttribute($image)
    {
        $this->clearMediaCollection("Attachment");
        $fileName = time() . Str::random(10);
        $fileNameWithExt = time() . Str::random(10) . '.' . $image->getClientOriginalExtension();
        $this->addMedia($image)
            ->usingFileName($fileNameWithExt)
            ->usingName($fileName)
            ->toMediaCollection("Attachment");
    }

}
