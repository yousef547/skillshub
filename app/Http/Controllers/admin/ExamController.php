<?php

namespace App\Http\Controllers\admin;

use App\Events\ExamaddedEvent;
use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Question;
use App\Models\satting;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExamController extends Controller
{
    public function index(){
        $data['exams'] = Exam::select('id','name','skill_id','img','active','questions_no')
        ->orderBy('id','DESC')->paginate(10);
        // $data['cats'] = Cat::select('id','name')->get();
        return view('admin.exam.index')->with($data);
    }
    public function create(){
        $data['skills']=Skill::select('name','id')->get();
        return view('admin.exam.create')->with($data);
    }
    public function edit(Exam $exam){
        $data['skills'] = Skill::select('id','name')->get();
        $data['exam'] = $exam;
        return view('admin.exam.edit')->with($data);
    }
    public function updata(Exam $exam ,Request $request) {
        $request->validate([
            'name_en'=> 'required|string|max:50',
            'name_ar'=> 'required|string|max:50',
            'desc_en'=> 'required|string|max:5000',
            'desc_ar'=> 'required|string|max:5000',
            'img' => 'nullable|image|max:2048',
            'skill_id' => 'required|exists:skills,id',
            'difficulty' => 'required|integer|min:1|max:5',
            'duration_mins' => 'required|integer|min:1',

        ]);
        $path = $exam->img;
        if($request->hasFile('img')) {
            Storage::delete($path);
            $path = Storage::putFile("exams", $request->file('img'));
        }
        $exam->update([
            'name'=> json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'desc'=> json_encode([
                'en' => $request->desc_en,
                'ar' => $request->desc_ar,
            ]),
            'img' => $path,
            'skill_id' =>$request->skill_id,
            'qifficulty' =>$request->difficulty,
            'duration_mins'=>$request->duration_mins,
        ]);
        $request->session()->flash('msgAdmin','you success you edited one row ');

        return redirect(url("dashboard/exams/show/$exam->id"));
    }
    public function show(Exam $exam){
        $data['exam'] = $exam;
        return view('admin.exam.show')->with($data);
    }
    public function showQuestions(Exam $exam){
        $data['exam'] = $exam;
        return view('admin.exam.questions')->with($data);
    }
    public function store(Request $request) {
        $request->validate([
            'name_en'=> 'required|string|max:50',
            'name_ar'=> 'required|string|max:50',
            'desc_en'=> 'required|string|max:500',
            'desc_ar'=> 'required|string|max:500',
            'img' => 'required|image|max:2048',
            'skill_id' => 'required|exists:skills,id',
            'questions_no' => 'required|integer:min:1',
            'difficulty' => 'required|integer|min:1|max:5',
            'duration_mins' => 'required|integer|min:1',

        ]);
     
        $path = Storage::putFile("exams", $request->file('img'));
       $exam = Exam::create([
            'name'=> json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'desc'=> json_encode([
                'en' => $request->desc_en,
                'ar' => $request->desc_ar,
            ]),
            'img' => $path,
            'skill_id' =>$request->skill_id,
            'questions_no' =>$request->questions_no,
            'qifficulty' =>$request->difficulty,
            'duration_mins'=>$request->duration_mins,
            'active'=> 0
        ]);
        $request->session()->flash('prev',"exam/$exam->id");
        return redirect(url("dashboard/exams/create-questions/{$exam->id}"));
    }
    public function createQuestions(Exam $exam){
        if (session('prev') !== "exam/$exam->id" and session('curranty') !== "exam/$exam->id") {
            return redirect(url('dashboard/exams'));
        }
        $data['exam_id'] = $exam->id;
        $data['questions_na'] = $exam->questions_no;
        return view('admin.exam.create-questions')->with($data);
    }
    public function storeQuestions(Exam $exam, Request $request){
        $request->session()->flash('curranty',"exam/$exam->id");
        $request->validate([
            'titles' => 'required|array',
            'titles.*' => 'required|string|max:500',
            'right_anss' => 'required|array',
            'right_anss.*' => 'required|in:1,2,3,4',
            'option_1s' => 'required|array',
            'option_1s.*' => 'required|string|max:255',
            'option_2s' => 'required|array',
            'option_2s.*' => 'required|string|max:255',
            'option_3s' => 'required|array',
            'option_3s.*' => 'required|string|max:255',
            'option_4s' => 'required|array',
            'option_4s.*' => 'required|string|max:255',
        ]);
        for($i=0;$i < $exam->questions_no;$i++){
            Question::create([
                'exam_id' => $exam->id,
                'title' => $request->titles[$i],
                'option_1' => $request->option_1s[$i],
                'option_2' => $request->option_2s[$i],
                'option_3' => $request->option_3s[$i],
                'option_4' => $request->option_4s[$i],
                'right_ans' => $request->right_anss[$i]
            ]);
        }
        $exam->update([
            'active' => 1,
        ]);
        event(new ExamaddedEvent);
        return redirect(url('dashboard/exams'));
    }
    public function delete($id, Request $request){
        $oExam = Exam::findOrFail($id);
        if($oExam->questions->count() > 0){
            $request->session()->flash('msgAdmin','this exam has questions you mustnt deleted');
            return back();
        }
        $path = $oExam->img;
        Storage::delete($path);
        $oExam->delete();
        return back();
    }
    public function toggal($id, Request $request) {
        $oExam = Exam::findOrFail($id);
        $oExam->update([
            'active' => ! $oExam->active,
        ]);
        if($oExam->active) {
            $request->session()->flash('msgAdmin','this Exam active ');
        } else {
            $request->session()->flash('msgAdmin','this Exam not active ');
        }
        return back();
    }
    public function editQuestions(Exam $exam,Question $questions){
        $data['exam'] = $exam;
        $data['ques'] = $questions;
        return view('admin.exam.editQuestions')->with($data);
    }
    public function updateQuestions(Exam $exam,Question $questions, Request $request){
       $data = $request->validate([
            'title' => 'required|string|max:500',
            'right_ans' => 'required|in:1,2,3,4',
            'option_1' => 'required|string|max:255',
            'option_2' => 'required|string|max:255',
            'option_3' => 'required|string|max:255',
            'option_4' => 'required|string|max:255',
        ]);
        $questions->update($data);
        return redirect(url("dashboard/exams/show/$exam->id"));
    }
}

