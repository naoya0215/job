<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\Job;
use App\Models\Applicant;
use App\Models\Company;


class AdminhomeController extends Controller
{

    public function __construct() 
    {
        $this->middleware('auth:admin');
    }

    public function index() {
        $admin = Auth::user();

        // 管理者が所属する会社のIDを取得
        $companyIds = Company::where('admin_id', $admin->id)->pluck('id');

        // 会社IDに基づいて求人を取得
        $jobs = Job::whereIn('company_id', $companyIds)
                   ->with('company')  // 会社情報をEager Loading
                   ->withCount('applicants')  // 各求人の応募数をカウント
                   ->get();

        // 全応募数を集計
        $totalApplicants = $jobs->sum('applicants_count');

        return view('admin.home', compact('admin', 'jobs', 'totalApplicants'));
    }

    public function unsubscribe()
    {
        $admin = Auth::user();

        // トランザクション開始
        DB::beginTransaction();

        try {
            // 関連する会社を取得
            $companies = Company::where('admin_id', $admin->id)->get();

            foreach ($companies as $company) {
                // 会社に関連する求人を削除
                Job::where('company_id', $company->id)->delete();

                // 会社を削除
                $company->delete();
            }

            // 管理者アカウントを削除
            $admin->delete();

            // トランザクションをコミット
            DB::commit();

            // ログアウト
            Auth::logout();

            return redirect()->route('admin.login')->with('status', '退会処理が完了しました。ご利用ありがとうございました。');
        } catch (\Exception $e) {
            // エラーが発生した場合はロールバック
            DB::rollback();
            return back()->with('error', '退会処理中にエラーが発生しました。もう一度お試しください。');
        }
    }
}