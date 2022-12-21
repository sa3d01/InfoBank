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
        $file = $this->getMedia("admins")->first();
        if ($file) {
            return $this->getMedia("admins")->first()->getFullUrl('thumb');
        }
        return asset('images/users/user.jpg');
    }

    protected function setAvatarAttribute($image)
    {
        $this->clearMediaCollection("admins");
        $fileName = time() . Str::random(10);
        $fileNameWithExt = time() . Str::random(10) . '.' . $image->getClientOriginalExtension();
        $this->addMedia($image)
            ->usingFileName($fileNameWithExt)
            ->usingName($fileName)
            ->toMediaCollection("admins");
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

}
