<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function show($id){
        $data['exams'] = Exam::findOrFail($id);
        $user =Auth::user();
        $data['canEnter'] = true;
        if($user !== null){
            $userExam = $user->exams()->where('exam_id',$id)->first();
            if($userExam !== null and $userExam->pivot->status == 'closed') {
                $data['canEnter'] = false; 
            }
        }
       
        return view('web.exams.show')->with($data);
        
    }
    public function start($examId, Request $request) {
        $users = Auth::user();
      
        if (!$users->exams->contains($examId)) {
            $users->exams()->attach($examId);
        } else {
            $users->exams()->updateExistingPivot($examId, [
                'status' => 'closed'
            ]);
        }
        $request->session()->flash('prev', "start/$examId"); 
        return redirect(url("exam/questions/$examId"));
    }
    public function questions($id,Request $request){
 
        if(session('prev') !== "start/$id") {
            return redirect(url("exam/show/$id"));
        }
        $data['exams'] = Exam::findOrFail($id);
        $request->session()->flash('prev', "questions/$id"); 
        return view('web.exams.questions')->with($data);
    }
    public function submit($examID, Request $request) {
        if(session('prev') !== "questions/$examID") {
            return redirect(url("exam/show/$examID"));
        }
        $request->validate(([
            'answers'=>'required|array',
            'answers.*'=>'required|in:1,2,3,4'
        ]));
        $score = 0;
        $exam = Exam::findOrFail($examID);
        $totalQuseNum = $exam->questions()->count();
        foreach($exam->questions as $question) {
            if(isset($request->answers[$question->id])){
                $userAns = $request->answers[$question->id];
                $rightAns = $question->right_ans;

                if($userAns == $rightAns) 
                    $score++;
            }
        }
        $perSent =($score/$totalQuseNum) * 100;
        $usere = Auth::user();
        $pivotRow = $usere->exams()->where('exam_id', $examID)->first();
        $startTime = $pivotRow->pivot->created_at;
        $submitTime = Carbon::now();
        $diffMins = $submitTime->diffInMinutes($startTime);
        if ($diffMins > $pivotRow->	duration_mins) {
            $perSent = 0;
        }
        $usere->exams()->updateExistingPivot($examID,[
            'score' => $perSent,
            'time_mins' => $diffMins,
            'status' => 'closed',
        ]);
        $request->session()->flash('success',"you fininshed exam successfully with score $perSent %");
        return redirect(url("exam/show/$examID")); 
    }
}
