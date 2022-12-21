<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Admin\Http\Requests\Auth\ProfileUpdateRequest;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }


    public function profile()
    {
        $row = Auth::guard('admin')->user();
        return view('admin::auth.profile', compact('row'));
    }
    public function updateProfile(ProfileUpdateRequest $request): object
    {
        $admin = Auth::guard('admin')->user();
        $admin->update($request->validated());
        return redirect()->back()->with('updated', 'تم التعديل بنجاح');
    }
}
