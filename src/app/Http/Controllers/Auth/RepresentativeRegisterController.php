<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Contracts\CreatesNewRepresentatives;
use App\Http\Responses\RepresentativeRegisterResponse;
use Laravel\Fortify\Fortify;

class RepresentativeRegisterController extends Controller
{
    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
     * @return void
     */
    public function __construct()
    {
        $this->guard = Auth::guard('representative');
    }

    /**
     * Show the registration view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\RegisterViewResponse
     */
    public function create()
    {
        return view('auth.representative_register');
    }

    /**
     * Create a new registered user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Laravel\Fortify\Contracts\CreatesNewAdmins  $creator
     * @return \Laravel\Fortify\Contracts\RegisterResponse
     */
    public function store(Request $request,
                          CreatesNewRepresentatives $creator): RepresentativeRegisterResponse
    {
        // 現在の管理者ユーザーをセッションに保存
        session()->put('admin_user', Auth::guard('admin')->user());

        if (config('fortify.lowercase_usernames')) {
            $request->merge([
                Fortify::username() => Str::lower($request->{Fortify::username()}),
            ]);
        }

        event(new Registered($representative = $creator->create($request->all())));

        $this->guard->login($representative);

        return app(RepresentativeRegisterResponse::class);
    }

    public function showDone()
    {
        // 店舗代表者のガードを指定してログアウト
        Auth::guard('representative')->logout();

        // セッションから管理者ユーザーを取得し、再ログインさせる
        if (session()->has('admin_user')) {
            Auth::guard('admin')->login(session()->get('admin_user'));
            // 管理者ユーザーのセッション情報を削除
            session()->forget('admin_user');
        }

        return view('representative_done');
    }
}
