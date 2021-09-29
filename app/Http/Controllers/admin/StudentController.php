<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index() {
        $studentRole = Role::where('name','student')->first();
        $data['students'] = User::where('role_id', $studentRole->id)
        ->orderBy('id','DESC')->paginate(10);
        return view('admin.student.index')->with($data);
    }
    public function showscores($id){
        $student = User::findORFail($id);
        if($student->role->name !== 'student') {
            return back();
        }
        $data['student'] = $student;
        $data['exams'] = $student->exams;
        // dd($data['exams']);
        return view('admin.student.show-scores')->with($data);
    }
    public function openExam($studentId,$examId){
        $student = User::findOrFail($studentId);
        $student->exams()->updateExistingPivot($examId, [
            'status' => 'opened',
        ]);
        return back();
    }
    public function closeExam($studentId,$examId){
        $student = User::findOrFail($studentId);
        $student->exams()->updateExistingPivot($examId, [
            'status' => 'closed',
        ]);
        return back();
    }
}