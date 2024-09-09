<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreRequest;
use App\Http\Requests\Admin\UpdateRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\PrimaryCategory;
use App\Models\SecondaryCategory;
use Illuminate\Support\Facades\Config;
use App\Models\Job;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
use Illuminate\Support\Facades\Storage;

class AdminjobController extends Controller
{
    public function __construct() 
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        // 認証されたAdminユーザーを取得
        $admin = Auth::guard('admin')->user();

        // システム管理者の場合
        if ($admin->can('super_admin')) {
            // システム管理者は全ての求人データを取得
            $jobs = DB::table('jobs')
            ->select('jobs.*', 'secondary_categories.name as category_name', 'primary_categories.name as primary_category_name')
            ->join('secondary_categories', 'jobs.secondary_category_id', '=', 'secondary_categories.id')
            ->join('primary_categories', 'secondary_categories.primary_category_id', '=', 'primary_categories.id')
            ->get();
        }

        // 企業ユーザーの場合
        elseif ($admin->can('admincompany')) {
            // 自分の企業を取得
            $company = Company::where('admin_id', $admin->id)->first();
            // 自分の企業が作成した求人データを取得
            $jobs = DB::table('jobs')
            ->select('jobs.*', 'secondary_categories.name as category_name', 'primary_categories.name as primary_category_name')
            ->join('secondary_categories', 'jobs.secondary_category_id', '=', 'secondary_categories.id')
            ->join('primary_categories', 'secondary_categories.primary_category_id', '=', 'primary_categories.id')
            ->where('company_id', $company->id)->get();
        }
        // 上記の条件に当てはまらない場合(無認可ユーザー)
        else {
            // 403 Forbidden エラーを返す
            abort(403, 'Unauthorized action.');
        }

        // 取得した求人データをビューに渡す
        return view('admin.adminjob.index', compact('jobs'));
    }

    public function create() 
    {
        $categories = PrimaryCategory::with('secondary')->get();
        $prefectures = Config::get('prefecture.types');
        return view('admin.adminjob.create', compact('categories', 'prefectures'));
    }

    public function store(StoreRequest $request) 
    {
        try {
            // 現在のログインユーザー（Admin）を取得
            $admin = Auth::guard('admin')->user();
            
            // Admin に関連付けられた Company を取得
            $company = Company::where('admin_id', $admin->id)->first();
            
            if (!$company) {
                throw new \Exception('現在のユーザーに関連付けられた企業が見つかりません。');
            }
    
            // 新しい Job インスタンスを作成
            $job = new Job();
            $job->title = $request->title;
            $job->description = $request->description;
            $job->secondary_category_id = $request->secondary_category_id;
            $job->location1 = $request->location1;
            $job->location2 = $request->location2 ?? null;
            $job->location3 = $request->location3 ?? null;
            $job->type = $request->type;
            $job->salary_type = $request->salary_type;
            $job->min_salary = $request->min_salary;
            $job->max_salary = $request->max_salary;
            $job->deadline = $request->deadline;
            $job->work_days_min = $request->work_days_min ?? null;
            $job->work_days_max = $request->work_days_max ?? null;
            $job->work_hours_start = $request->work_hours_start ?? null;
            $job->work_hours_end = $request->work_hours_end ?? null;
            $job->company_id = $company->id;

            //画像ファイルアップロード
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('job_images', 'public');
                $job->image_path = $imagePath;
            } else {
                // デフォルト画像をセット
                $job->image_path = 'job_images/no-image.jpg';
            }

            // データベースに保存
            $job->save();
    
            // 保存成功後、リダイレクト
            return redirect()->route('admin.adminjob.index')->with('success', '求人が正常に作成されました。');
        } catch (\Exception $e) {
            return redirect()->back()
                             ->withErrors($e->getMessage())
                             ->withInput();
        }
    }

    public function edit($id)
    {
        $job = Job::findOrFail($id);
        $categories = PrimaryCategory::with('secondary')->get();
        $prefectures = Config::get('prefecture.types');
        return view('admin.adminjob.edit', compact('job', 'categories', 'prefectures'));
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $job = Job::findOrFail($id);
            // 求人情報を更新
            $job->title = $request->title;
            $job->description = $request->description;
            $job->secondary_category_id = $request->secondary_category_id;
            $job->location1 = $request->location1;
            $job->location2 = $request->location2 ?? null;
            $job->location3 = $request->location3 ?? null;
            $job->type = $request->type;
            $job->salary_type = $request->salary_type;
            $job->min_salary = $request->min_salary;
            $job->max_salary = $request->max_salary;
            $job->deadline = $request->deadline;
            $job->work_days_min = $request->work_days_min ?? null;
            $job->work_days_max = $request->work_days_max ?? null;
            $job->work_hours_start = $request->work_hours_start ?? null;
            $job->work_hours_end = $request->work_hours_end ?? null;
            //リクエストにis_activeが含まれているかチェックする
            $job->is_active = $request->has('is_active') ? 1 : 0;

            // 画像ファイルの更新
            if ($request->hasFile('image')) {
                // 古い画像を削除
                if ($job->image_path) {
                    Storage::disk('public')->delete($job->image_path);
                }
                // 新しい画像をアップロード
                $imagePath = $request->file('image')->store('job_images', 'public');
                $job->image_path = $imagePath;
            }

            // データベースに保存
            $job->save();

            // 更新成功後、リダイレクト
            return redirect()->route('admin.adminjob.index')->with('success', '求人が正常に更新されました。');
        } catch (\Exception $e) {
            // エラーログの記録
            \Log::error('Job update failed: ' . $e->getMessage());
            
            // エラーメッセージをフラッシュデータとして保存
            return redirect()->back()->withInput()->with('error', '求人の更新に失敗しました。もう一度お試しください。');
        }
    }

    public function destroy($id)
    {
        try {
            $job = Job::findOrFail($id);

            // 関連する画像ファイルを削除
            if ($job->image_path) {
                Storage::disk('public')->delete($job->image_path);
            }

            // 求人を削除
            $job->delete();

            return redirect()->route('admin.adminjob.index')->with('success', '求人が正常に削除されました。');
        } catch (\Exception $e) {
            \Log::error('Job deletion failed: ' . $e->getMessage());
            return redirect()->back()->with('error', '求人の削除に失敗しました。もう一度お試しください。');
        }
    }
}