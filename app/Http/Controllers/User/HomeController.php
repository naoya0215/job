<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\Models\User;
use App\Models\PrimaryCategory;
use App\Models\SecondaryCategory;
use App\Models\Job;
use App\Models\Company;
use App\Models\Applicant;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth:users');
    }

    public function unsubscribe()
    {
        $user = Auth::user();

        // トランザクション開始
        DB::beginTransaction();

        try {
            // ユーザーの応募情報を削除
            Applicant::where('user_id', $user->id)->delete();

            // その他のユーザー関連データを削除
            // 例: プロフィール情報、メッセージなど
            // $user->profile()->delete();
            // $user->messages()->delete();

            // ユーザーアカウントを削除
            $user->delete();

            // トランザクションをコミット
            DB::commit();

            // ログアウト
            Auth::logout();

            return redirect()->route('user.login')->with('status', '退会処理が完了しました。ご利用ありがとうございました。');
        } catch (\Exception $e) {
            // エラーが発生した場合はロールバック
            DB::rollback();
            return back()->with('error', '退会処理中にエラーが発生しました。もう一度お試しください。');
        }
    }

    public function index(Request $request) 
    {
        $query = Job::with('company.admin', 'secondaryCategory')
        ->where('is_active', 1);

        // キーワード検索
        if ($request->filled('keyword')) {
            $keyword = $request->input('keyword');
            $query->where(function($q) use ($keyword) {
                $q->where('title', 'LIKE', "%{$keyword}%")
                ->orWhereHas('company.admin', function($q) use ($keyword) {
                    $q->where('name', 'LIKE', "%{$keyword}%");
                });
            });
        }

        // 勤務地検索
        if ($request->filled('location')) {
            $location = $request->input('location');
            $query->where(function($q) use ($location) {
                $q->where('location1', $location)
                ->orWhere('location2', $location)
                ->orWhere('location3', $location);
            });
        }

        // 雇用形態検索
        if ($request->filled('employment_type')) {
            $query->where('type', $request->input('employment_type'));
        }

        // 給与範囲検索
        if ($request->filled('salary_min')) {
            $query->where('max_salary', '>=', $request->input('salary_min'));
        }
        if ($request->filled('salary_max')) {
            $query->where('min_salary', '<=', $request->input('salary_max'));
        }

        // 応募締め切り日検索
        if ($request->filled('deadline')) {
            $query->where('deadline', '>=', $request->input('deadline'));
        }

        // カテゴリ検索
        if ($request->filled('category')) {
            $query->where('secondary_category_id', $request->input('category'));
        }

        $jobs = $query->latest()->paginate(10);
        $prefectures = Config::get('prefecture.types');
        $categories = SecondaryCategory::pluck('name', 'id');

        return view('user.home', compact('jobs', 'prefectures', 'categories'));
    }

    public function historycreate()
    {
        $user = Auth::user();
        $applicant = Applicant::where('user_id', $user->id)->first();

        if (!$applicant) {
            $applicant = new Applicant();  // ユーザーが初めてフォームにアクセスする場合
        }

        return view('user.history', compact('applicant'));
    }

    public function historystore(Request $request)
    {
        $user = Auth::user();

        // ユーザーが認証されていない場合はログインページにリダイレクト
        if (!$user) {
            return redirect()->route('user.login')->with('message', '応募するにはログインが必要です。');
        }

        $applicant = Applicant::where('user_id', $user->id)->first();

        if ($applicant) {
            $applicant->sex = $request->sex;
            $applicant->birth_date = $request->birth_date;
            $applicant->phone_number = $request->phone_number;
            $applicant->employment_status = $request->employment_status;
            $applicant->self_pr = $request->self_pr ?? null;
            $applicant->academic_status = $request->academic_status;
            $applicant->schoolname = $request->schoolname ?? null;
            $applicant->faculty = $request->faculty ?? null;
            $applicant->graduation = $request->graduation ?? null;
            $applicant->graduation_month = $request->graduation_month ?? null;
            $applicant->jobchange = $request->jobchange ?? null;
            $applicant->experienced1 = $request->experienced1 ?? null;
            $applicant->experienced_years1 = $request->experienced_years1 ?? null;
            $applicant->experienced_content1 = $request->experienced_content1 ?? null;
            $applicant->experienced2 = $request->experienced2 ?? null;
            $applicant->experienced_years2 = $request->experienced_years2 ?? null;
            $applicant->experienced_content2 = $request->experienced_content2 ?? null;
            $applicant->experienced3 = $request->experienced3 ?? null;
            $applicant->experienced_years3 = $request->experienced_years3 ?? null;
            $applicant->experienced_content3 = $request->experienced_content3 ?? null;

            $applicant->save();

        } else {
            // 新しい Applicant インスタンスを作成
            $applicant = new Applicant();
            $applicant->user_id = $user->id;
            $applicant->job_id = $request->job_id ?? null;
            $applicant->sex = $request->sex;
            $applicant->birth_date = $request->birth_date;
            $applicant->phone_number = $request->phone_number;
            $applicant->employment_status = $request->employment_status;
            $applicant->self_pr = $request->self_pr ?? null;
            $applicant->academic_status = $request->academic_status;
            $applicant->schoolname = $request->schoolname ?? null;
            $applicant->faculty = $request->faculty ?? null;
            $applicant->graduation = $request->graduation ?? null;
            $applicant->graduation_month = $request->graduation_month ?? null;
            $applicant->jobchange = $request->jobchange ?? null;
            $applicant->experienced1 = $request->experienced1 ?? null;
            $applicant->experienced_years1 = $request->experienced_years1 ?? null;
            $applicant->experienced_content1 = $request->experienced_content1 ?? null;
            $applicant->experienced2 = $request->experienced2 ?? null;
            $applicant->experienced_years2 = $request->experienced_years2 ?? null;
            $applicant->experienced_content2 = $request->experienced_content2 ?? null;
            $applicant->experienced3 = $request->experienced3 ?? null;
            $applicant->experienced_years3 = $request->experienced_years3 ?? null;
            $applicant->experienced_content3 = $request->experienced_content3 ?? null;

            $applicant->save();
        }
            
        // 保存成功後、リダイレクト
        return redirect()->route('user.user.home')->with('success', 'Web履歴書が正常に作成されました。');
    }  

    //日付変換
    private function formatTime($time)
    {
        return $time ? Carbon::createFromFormat('H:i:s', $time)->format('H:i') : '';
    }

    public function usershow($id)
    {
        $job = Job::with(['company.admin', 'secondaryCategory'])->findOrFail($id);

        // 勤務時間のフォーマット
        $job->formatted_work_hours_start = $this->formatTime($job->work_hours_start);
        $job->formatted_work_hours_end = $this->formatTime($job->work_hours_end);

        // 関連する求人を取得（例：同じ会社の他の求人）
        $relatedJobs = Job::where('company_id', $job->company_id)
                        ->where('id', '!=', $job->id)
                        ->take(3)
                        ->get();

        return view('user.usershow', compact('job','relatedJobs'));
    }

    //履歴書を表示
    public function userinfo($id)
    {
        $user = Auth::user();
        $applicant = Applicant::where('user_id', $user->id)->first();

        if ($applicant) {
            $job = Job::findOrFail($id);
            // 自分の履歴書を表示する
            return view('user.userinfo', compact('applicant', 'job'));
        } else {
            // 履歴書がない場合はWeb履歴書の作成ページにリダイレクト
            return redirect()->route('user.user.usershow',['id' => $id])->with('message', '応募を行う場合は、Web履歴書の作成を行ってください。');
        }
    }

    public function userComplete($id)
    {
        $user = Auth::user();
        $applicant = Applicant::where('user_id', $user->id)->first();
    
        if (is_null($applicant->job_id)) {
            // job_idがnullの場合、既存のレコードを更新
            $applicant->job_id = $id;
            $applicant->status = '応募済み'; //応募済み
            $applicant->save();

            $job = Job::findOrFail($id);
            return view('user.usercomplete', compact('job'));

        } elseif ($applicant->job_id != $id) {
            // job_idがnullでなく、かつ新しいidと異なる場合、新しいレコードを作成
            $newApplicant = new Applicant();
            $newApplicant->user_id = $user->id;
            $newApplicant->job_id = $id;
            $newApplicant->status = '応募済み'; //応募済み
            $newApplicant->employment_status = $applicant->employment_status;
            $newApplicant->sex = $applicant->sex;
            $newApplicant->birth_date = $applicant->birth_date;
            $newApplicant->phone_number = $applicant->phone_number;
            $newApplicant->employment_statust = $applicant->employment_status;
            $newApplicant->self_pr = $applicant->self_pr;
            $newApplicant->academic_status = $applicant->academic_status;
            $newApplicant->schoolname = $applicant->schoolname;
            $newApplicant->faculty = $applicant->faculty;
            $newApplicant->graduation = $applicant->graduation;
            $newApplicant->graduation_month = $applicant->graduation_month;
            $newApplicant->jobchange = $applicant->jobchange;
            $newApplicant->experienced1 = $applicant->experienced1;
            $newApplicant->experienced_years1 = $applicant->experienced_years1;
            $newApplicant->experienced_content1 = $applicant->experienced_content1;
            $newApplicant->experienced2 = $applicant->experienced2;
            $newApplicant->experienced_years2 = $applicant->experienced_years2;
            $newApplicant->experienced_content2 = $applicant->experienced_content2;
            $newApplicant->experienced3 = $applicant->experienced3;
            $newApplicant->experienced_years3 = $applicant->experienced_years3;
            $newApplicant->experienced_content3 = $applicant->experienced_content3;
            
            $newApplicant->save();

            $job = Job::findOrFail($id);
            return view('user.usercomplete', compact('job'));
        } else {
            // job_idが既に設定されていて、新しいidと同じ場合
            return redirect()->back()->with('info', 'この求人には既に応募済みです。');
        }
    }
}