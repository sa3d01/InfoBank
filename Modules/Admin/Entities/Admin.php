<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Admin extends Authenticatable implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    public function registerMediaConversions($media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10);
    }
    protected $guard = 'admin';

    protected $fillable = [
        'name', 'email', 'password','avatar'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected function getAvatarAttribute()
    {
        $file = $this->getMedia("Admin")->first();
        if ($file) {
            return url("media/" . $file->id . "/" . $file->file_name);
        }
        return asset('images/logo.png');
    }

    /**
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist
     * @throws \Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig
     */
    protected function setAvatarAttribute($image)
    {
        $this->clearMediaCollection("Admin");
        $fileName = time() . Str::random(10);
        $fileNameWithExt = time() . Str::random(10) . '.' . $image->getClientOriginalExtension();
        $this->addMedia($image)
            ->usingFileName($fileNameWithExt)
            ->usingName($fileName)
            ->toMediaCollection("Admin");
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

}
