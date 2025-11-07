<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate(['password' => 'required|string']);
        $expected = env('ADMIN_PASSWORD', 'admin123');
        if (hash_equals($expected, $request->input('password'))) {
            $request->session()->put('admin_authenticated', true);
            $intended = session('intended');
            if ($intended) {
                session()->forget('intended');
                return redirect()->to($intended);
            }
            return redirect()->route('admin.index');
        }
        return back()->withErrors(['password' => 'Неверный пароль'])->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_authenticated');
        return redirect()->route('admin.login');
    }
}





