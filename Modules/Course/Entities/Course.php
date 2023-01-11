<?php

namespace Modules\Course\Entities;

use App\Traits\ApiResponseTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

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

        'cover',
        'company_logo',

        //offline
        'start_date',
        'end_date',
        'location_title',
        'location_type',
        'location',

        'banned',
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
        try {
            $this->addMedia($image)
                ->usingFileName($fileNameWithExt)
                ->usingName($fileName)
                ->toMediaCollection("Course");
        } catch (FileDoesNotExist | FileIsTooBig $e) {
        }
    }

    protected function getCompanyLogoAttribute()
    {
        $file = $this->getMedia("CourseCompanyLogo")->first();
        if ($file) {
            return url("media/" . $file->id . "/" . $file->file_name);
        }
        return "";
    }

    protected function setCompanyLogoAttribute($image)
    {
        $this->clearMediaCollection("CourseCompanyLogo");
        $fileName = time() . Str::random(10);
        $fileNameWithExt = time() . Str::random(10) . '.' . $image->getClientOriginalExtension();
        try {
            $this->addMedia($image)
                ->usingFileName($fileNameWithExt)
                ->usingName($fileName)
                ->toMediaCollection("CourseCompanyLogo");
        } catch (FileDoesNotExist | FileIsTooBig $e) {
        }
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

    public function rate()
    {
        $raters = Comment::where('course_id', $this->id)->count();
        $rates = Comment::where('course_id', $this->id)->sum('rate');
        if ($raters > 0) {
            $response['rate'] = round($rates / $raters);
        } else {
            $response['rate'] = 0;
        }
        $response['raters'] = $raters;
        return $response;
    }

    public function sessions()
    {
        return $this->hasManyThrough(Session::class, Chapter::class, 'course_id', 'chapter_id');
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'course_id', 'id');
    }
    public function chapters()
    {
        return $this->hasMany(Chapter::class, 'course_id', 'id');
    }

    public function subscribes()
    {
        return $this->hasMany(Subscribe::class, 'course_id', 'id');
    }

    public function chapterLabel()
    {
        $count=$this->chapters->count();
        $route=route('admin.course.chapters',$this->id);
        return"<a  href='$route' class='badge badge-soft-info'>
                $count
                </a>";
    }

    public function sessionLabel()
    {
        $count=$this->sessions->count();
        $route=route('admin.course.sessions',$this->id);
        return"<a  href='$route' class='badge badge-soft-success'>
                $count
                </a>";
    }

    public function attachmentLabel()
    {
        $count=$this->attachments->count();
        $route=route('admin.course.attachments',$this->id);
        return"<a  href='$route' class='badge badge-soft-dark'>
                $count
                </a>";
    }

    public function studentLabel()
    {
        $count=$this->subscribes->count();
        $route=route('admin.course.subscribes',$this->id);
        return"<a  href='$route' class='badge badge-soft-warning'>
                $count
                </a>";
    }

}
