<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\RegisterRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('user.auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::guard('users')->login($user);

        return $this->registered($request, $user);
    }


    //セッションに job_id_to_applyが存在する場合(JobController確認)は求人応募ページに、
    //そうでない場合はホームページにリダイレクト
    protected function registered(Request $request, $user)
    {
        if ($request->session()->has('job_id_to_apply')) {
            $jobId = $request->session()->pull('job_id_to_apply');
            return redirect()->route('user.job.apply', ['id' => $jobId]);
        }

        return redirect(RouteServiceProvider::HOME);
    }
}