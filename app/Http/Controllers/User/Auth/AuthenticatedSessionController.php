<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        if ($request->has('job_id_to_apply')) {
            $request->session()->put('job_id_to_apply', $request->input('job_id_to_apply'));
        }

        return view('user.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return $this->authenticated($request);
    }


    //セッションに job_id_to_applyが存在する場合(JobController確認)は求人応募ページに、
    //そうでない場合はホームページにリダイレクト
    protected function authenticated(Request $request)
    {
        if ($request->session()->has('job_id_to_apply')) {
            $jobId = $request->session()->pull('job_id_to_apply');
            return redirect()->route('user.job.apply', ['id' => $jobId]);
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('users')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}