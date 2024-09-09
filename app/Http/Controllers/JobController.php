<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use App\Models\PrimaryCategory;
use App\Models\SecondaryCategory;
use App\Models\Job;
use App\Models\Company;
use App\Models\Applicant;
use Carbon\Carbon;

class JobController extends Controller
{
    
    public function index () 
    {
        return view('job.index');
    }

    public function list(Request $request)
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

        return view('job.list', compact('jobs', 'prefectures', 'categories'));
    }

    //日付変換
    private function formatTime($time)
    {
        return $time ? Carbon::createFromFormat('H:i:s', $time)->format('H:i') : '';
    }

    public function show($id) 
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

        return view('job.show', compact('job','relatedJobs'));
    }

    public function info($id) 
    {
        $job = Job::findOrFail($id);

        // セッションに job_id_to_apply を保存
        session(['job_id_to_apply' => $id]);

        return view('job.info', compact('job', 'id'));
    }

    public function apply($id)
    {
        $job = Job::findOrFail($id);
        $user = Auth::user();

        $applicant = Applicant::where('user_id', $user->id)->first();

        if (!$applicant) {
            $applicant = new Applicant();  // ユーザーが初めてフォームにアクセスする場合
        }

        // ユーザーが認証されていない場合はログインページにリダイレクト
        if (!$user) {
            return redirect()->route('user.login')->with('message', '応募するにはログインが必要です。');
        }

        // 応募フォームに必要な情報を準備
        $formData = [
            'job_id' => $job->id,
            'job_title' => $job->title,
            'company_name' => $job->company->name,
            'user_name' => $user->name,
            'user_email' => $user->email,
        ];

        return view('job.apply', compact('job', 'user', 'applicant', 'formData'));
    }

    public function applystore(Request $request , $id) 
    {
        try {
            // バリデーションルール
            $rules = [
                'job_id' => 'required|exists:jobs,id',
                'sex' => 'nullable|in:male,female,other',
                'birth_date' => 'nullable|date',
                'phone_number' => 'nullable|string|max:20',
                'employment_status' => 'nullable|in:employed,unemployed,student,other',
                'self_pr' => 'nullable|string|max:1000',
            ];

            // バリデーション
            $validatedData = $request->validate($rules);

            // 現在のログインユーザー（user）を取得
            $user = Auth::user();
            $job = Job::findOrFail($id);

            // 新しい Applicant インスタンスを作成
            $applicant = new Applicant();
            $applicant->user_id = $user->id;
            $applicant->job_id = $job->id;
            $applicant->status = '応募済み'; //応募済み
            $applicant->sex = $validatedData['sex'] ?? null;
            $applicant->birth_date = $validatedData['birth_date'] ?? null;
            $applicant->phone_number = $validatedData['phone_number'] ?? null;
            $applicant->employment_status = $validatedData['employment_status'] ?? null;
            $applicant->self_pr = $validatedData['self_pr'] ?? null;

            // データベースに保存
            $applicant->save();

            // 保存成功後、リダイレクト
            return redirect()->route('user.job.applycomplete', ['id' => $id])->with('success', '応募が完了しました。');
        } catch (\Exception $e) {
            // エラーログの記録
            \Log::error('Application failed: ' . $e->getMessage());

            // エラーメッセージをフラッシュデータとして保存
            return redirect()->back()->withInput()->with('error', '応募に失敗しました。もう一度お試しください。');
        }
    }

    public function applyComplete($id)
    {
        $job = Job::findOrFail($id);
        return view('job.applycomplete', compact('job'));
    }
}
