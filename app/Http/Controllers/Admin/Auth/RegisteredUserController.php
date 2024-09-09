<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Prefecture;
use App\Models\Company;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $prefectures = Prefecture::get();
        return view('admin.auth.register', compact('prefectures'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'], //企業名
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'description' => ['required', 'string'],
            'location' => ['required', 'string','max:255'],
            'website' => ['nullable', 'url'],
            'prefecture_id' => ['required', 'exists:prefectures,id'], 
        ]);

        DB::beginTransaction(); 

        try {
            $user = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            // 既存の都道府県を取得
            $prefecture = Prefecture::findOrFail($request->prefecture_id);

            $managementNumber = Company::generateManagementNumber($prefecture->prefecture_number);

            $company = Company::create([
                'description' => $request->description,
                'location' => $request->location,
                'website' => $request->website,
                'admin_id' => $user->id,
                'prefecture_id' => $prefecture->id,
                'prefecture_name' => $prefecture->prefecture_name,
                'prefecture_number' => $prefecture->prefecture_number,
                'management_number' => $managementNumber,
            ]);

            DB::commit();

            event(new Registered($user));

            Auth::guard('admin')->login($user);

            if ($request->expectsJson()) {
                return response()->json(['success' => true, 'redirect' => RouteServiceProvider::ADMIN_HOME]);
            }

            return redirect(RouteServiceProvider::ADMIN_HOME);
        } catch (\Exception $e) {
            DB::rollback();
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
            }
            return back()->withInput()->withErrors(['error' => 'Registration failed. Please try again.']);
        }
    }
}