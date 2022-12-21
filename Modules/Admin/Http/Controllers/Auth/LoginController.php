<?php

namespace Modules\Admin\Http\Controllers\Auth;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Admin\Http\Requests\Auth\AdminLoginRequest;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin', ['only' => ['logout']]);
    }

    public function showLoginForm()
    {
        return view('admin::auth.login');
    }

    public function login(AdminLoginRequest $request)
    {
        $request->validated();
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->intended(route('admin.home'));
        }
        return redirect()
            ->back()
            ->withInput()
            ->withErrors(['يوجد مشاكل بالبيانات المدخلة .. من فضلك حاول ثانية']);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }
}
