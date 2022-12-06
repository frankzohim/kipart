<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\Auth\LoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.user.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        if(Auth::guard('web')){
            $request->authenticate();

            $response = Http::post('http://kipart.stillforce.tech/oauth/token', [
                'grant_type'    => 'password',
                'username' => $request->email,
                'password' =>$request->password,
                'client_secret' => 'VdjAa5yZBeUjrk86mnAGFW28nWV0IoDBATpXHkke',
                'client_id'=>2
            ]);
            $access_token = json_decode((string) $response->getBody(), true)['access_token'];

            Session::put('token', $access_token);
            Session::save();
        $request->session()->regenerate();


            return to_route('user.dashboard');
        }else{
            return redirect()->route('user.login')->with('fail','incorrect incredentials');
        }

    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
