<?php

namespace Modules\Course\Entities;

use App\Traits\ApiResponseTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Course extends Model implements HasMedia
{
    use HasFactory, ApiResponseTrait, InteractsWithMedia;

    protected $fillable = [
        'type',
        'for',
        'title',
        'description',
        'features',
        'company_name',
        'company_desc',
        'start_date',
        'end_date',
        'cover',
        'company_logo',
    ];


    public function registerMediaConversions($media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }

    protected function getCoverAttribute()
    {
        $file = $this->getMedia("Course")->first();
        if ($file) {
            return url("media/" . $file->id . "/" . $file->file_name);
        }
        return "";
    }

    protected function setCoverAttribute($image)
    {
        $this->clearMediaCollection("Course");
        $fileName = time() . Str::random(10);
        $fileNameWithExt = time() . Str::random(10) . '.' . $image->getClientOriginalExtension();
        $this->addMedia($image)
            ->usingFileName($fileNameWithExt)
            ->usingName($fileName)
            ->toMediaCollection("Course");
    }
    protected function getCompanyLogoAttribute()
    {
        $file = $this->getMedia("CompanyLogo")->first();
        if ($file) {
            return url("media/" . $file->id . "/" . $file->file_name);
        }
        return "";
    }
    protected function setCompanyLogoAttribute($image)
    {
        $this->clearMediaCollection("CompanyLogo");
        $fileName = time() . Str::random(10);
        $fileNameWithExt = time() . Str::random(10) . '.' . $image->getClientOriginalExtension();
        $this->addMedia($image)
            ->usingFileName($fileNameWithExt)
            ->usingName($fileName)
            ->toMediaCollection("CompanyLogo");
    }
    public function getStartDateAttribute()
    {
        if ($this->attributes['start_date'])
            return Carbon::parse($this->attributes['start_date'])->format('Y/m/d');
        return 'غير محدد';
    }
    public function getEndDateAttribute()
    {
        if ($this->attributes['end_date'])
            return Carbon::parse($this->attributes['end_date'])->format('Y/m/d');
        return 'غير محدد';
    }
    public function rate(){
        $raters=Comment::where('course_id',$this->id)->count();
        $rates=Comment::where('course_id',$this->id)->sum('rate');
        if ($raters>0){
            $response['rate']=round($rates/$raters);
        }else{
            $response['rate']=0;
        }
        $response['raters']=$raters;
        return $response;
    }
    public function sessions()
    {
        return $this->hasManyThrough(Session::class, Chapter::class,'course_id','chapter_id');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class,'course_id','id');
    }


}
