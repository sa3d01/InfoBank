<?php

namespace Modules\Enrichment\Entities;

use App\Traits\ApiResponseTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Enrichment extends Model implements HasMedia
{
    use HasFactory, ApiResponseTrait, InteractsWithMedia;

    protected $table="enrichments";

    protected $fillable = [
        'title',
        'description',
        'media_link',
        'pdf',
        'image',
        'banned',
    ];


    public function registerMediaConversions($media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }

    protected function getImageAttribute()
    {
        $file = $this->getMedia("EnrichmentImage")->first();
        if ($file) {
            return url("media/" . $file->id . "/" . $file->file_name);
        }
        return "";
    }

    protected function setImageAttribute($image)
    {
        $this->clearMediaCollection("EnrichmentImage");
        $fileName = time() . Str::random(10);
        $fileNameWithExt = time() . Str::random(10) . '.' . $image->getClientOriginalExtension();
        $this->addMedia($image)
            ->usingFileName($fileNameWithExt)
            ->usingName($fileName)
            ->toMediaCollection("EnrichmentImage");
    }

    protected function getPdfAttribute()
    {
        $file = $this->getMedia("EnrichmentPdf")->first();
        if ($file) {
            return url("media/" . $file->id . "/" . $file->file_name);
        }
        return "";
    }

    protected function setPdfAttribute($image)
    {
        $this->clearMediaCollection("EnrichmentPdf");
        $fileName = time() . Str::random(10);
        $fileNameWithExt = time() . Str::random(10) . '.' . $image->getClientOriginalExtension();
        $this->addMedia($image)
            ->usingFileName($fileNameWithExt)
            ->usingName($fileName)
            ->toMediaCollection("EnrichmentPdf");
    }
}
