<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ExamResource;
use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    public function show($id) {
        $exam = Exam::find($id);
        if($exam == null) {
            return response()->json([
                'msg'=>'not found skill',
            ]);
        }
        return new ExamResource($exam);
    }
    public function show_question($id) {
        $exam = Exam::with('questions')->find($id);
        if($exam == null) {
            return response()->json([
                'msg'=>'not found skill',
            ]);
        }
        return new ExamResource($exam);
    }

    // public function start($examId, Request $request) {
    //     $users = Auth::user();
      
    //     if (!$users->exams->contains($examId)) {
    //         $users->exams()->attach($examId);
    //     } else {
    //         $users->exams()->updateExistingPivot($examId, [
    //             'status' => 'closed'
    //         ]);
    //     }
    //     $request->session()->flash('prev', "start/$examId"); 
    //     return redirect(url("exam/questions/$examId"));
    // }

    public function submit($id, Request $request) {
       
        $validator = Validator ::make($request->all(),[
            'answers'=>'required|array',
            'answers.*'=>'required|in:1,2,3,4'
        ]);
        if($validator->fails()) {
            return response()->json($validator->errors());
        }
        $score = 0;
        $exam = Exam::findOrFail($id);
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
        return response()->json($perSent);

        // $usere = Auth::user();
        // $pivotRow = $usere->exams()->where('exam_id', $id)->first();
        // $startTime = $pivotRow->pivot->created_at;
        // $submitTime = Carbon::now();
        // $diffMins = $submitTime->diffInMinutes($startTime);
        // if ($diffMins > $pivotRow->	duration_mins) {
        //     $perSent = 0;
        // }
        // $usere->exams()->updateExistingPivot($id,[
        //     'score' => $perSent,
        //     'time_mins' => $diffMins,
        //     'status' => 'closed',
        // ]);
        // $request->session()->flash('success',"you fininshed exam successfully with score $perSent %");
        // return redirect(url("exam/show/$id")); 
    }
}
