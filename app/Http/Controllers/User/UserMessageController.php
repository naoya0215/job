<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Applicant;
use App\Models\AdminMessage;
use App\Models\UserMessage;
use App\Models\Job;
use App\Models\Company;

class UserMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }

    public function index()
    {
        $user = Auth::user();
        $applicants = Applicant::where('user_id', $user->id)
                                ->whereHas('job')  // jobが存在するレコードのみを取得
                                ->with(['job.company', 'adminmessages', 'usermessages'])
                                ->get();

        return view('user.usermessage.index', compact('applicants'));
    }

    public function show($id)
    {
        $user = Auth::user();
        $applicant = Applicant::where('user_id', $user->id)
                            ->with(['job.company', 'adminMessages', 'userMessages'])
                            ->findOrFail($id);

        if($applicant->user_id !== $user->id) {
            return redirect()->route('user.usermessage.index')->with('error', 'アクセス権限がありません。');
        }

        return view('user.usermessage.show', compact('applicant'));
    }

    public function store(Request $request, $id)
    {
        $user = Auth::user();
        $applicant = Applicant::findOrFail($id);

        if ($applicant->user_id !== $user->id) {
            return abort(403, 'Unauthorized action.');
        }

        $message = new UserMessage();
        $message->applicant_id = $applicant->id;
        $message->user_id = $user->id;
        $message->content = $request->input('content');
        $message->save();

        return redirect()->route('user.usermessage.show', $applicant->id)->with('success', 'メッセージを送信しました。');
    }
}
