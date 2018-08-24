<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\ManageRole;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    /**
     *
     * @return view
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     *
     * @return view
     */
    public function login(LoginRequest $request)
    {
        $inputs = $request->only('email', 'password');
        $auth = \Auth::guard();
        if ($auth->attempt($inputs))
        {
            $userRoleId = \Auth::user()->manage_role_id;
            $manageRoles = ManageRole::where('id', $userRoleId)->first();
            session(['role_name' => $manageRoles->role_name]);
            return redirect(route('listUser'));
        }
        return redirect()->back()->with('error', iniGetMessage('MSG_AUTHERR_01'));
    }

    /**
     * ログアウト
     *
     * @return ログアウト完了画面
     */
    public function logout()
    {
        \Auth::logout();
        Session::forget('role_name');
        return redirect(route('listUser'));
    }
}
