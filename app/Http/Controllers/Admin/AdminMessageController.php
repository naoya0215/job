<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Applicant;
use App\Models\Job;
use App\Models\Company;
use App\Models\AdminMessage;
use App\Models\UserMessage;

class AdminMessageController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        //関連する企業IDを取得
        $companyIds = Company::where('admin_id', $admin->id)->pluck('id');
        //関連する求人を取得
        $jobIds = Job::whereIn('company_id', $companyIds)->pluck('id');

        $applicants = Applicant::with('user', 'job.company')
                                ->whereIn('job_id', $jobIds)
                                ->where('status', '応募済み')
                                ->get();

        return view('admin.message.index', compact('applicants'));
    }

    public function show($id)
    {
        $admin = Auth::guard('admin')->user();
        $applicant = Applicant::with('user', 'job', 'adminmessages', 'usermessages')->findOrFail($id);

        if($applicant->job->company->admin_id !== $admin->id) {
            return redirect()->route('admin.message.index')->with('error', 'アクセス権限がありません。');
        }

        return view('admin.message.show', compact('applicant'));
    }

    public function store(Request $request, $id)
    {
        $admin = Auth::guard('admin')->user();
        $applicant = Applicant::findOrFail($id);

        $message = new AdminMessage();
        $message->applicant_id = $applicant->id;
        $message->admin_id = $admin->id;
        $message->content = $request->input('content');
        $message->save();

        return redirect()->route('admin.message.show', $applicant->id)->with('success', 'メッセージを送信しました。');
    }
}
