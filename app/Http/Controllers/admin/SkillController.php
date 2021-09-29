<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SkillController extends Controller
{
    public function index(){
        $data['skills'] = Skill::orderBy('id','DESC')->paginate(10);
        $data['cats'] = Cat::select('id','name')->get();
        return view('admin.skill.index')->with($data);
    }
    public function store(Request $request) {
        $request->validate([
            'name_en'=> 'required|string|max:50',
            'name_ar'=> 'required|string|max:50',
            'img' => 'required|image|max:2048',
            'cat_id' => 'required|exists:cats,id'
        ]);
     
        $path = Storage::putFile("skills", $request->file('img'));
        Skill::create([
            'name'=> json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'img' => $path,
            'cat_id' =>$request->cat_id,
        ]);
        $request->session()->flash('msgAdmin','you success you add one row ');

        return back();
    }
    public function updata(Request $request) {
        // dd($request->all());
        $request->validate([
            'id' => 'required|exists:skills,id',
            'name_en'=> 'required|string|max:50',
            'name_ar'=> 'required|string|max:50',
            'img' => 'nullable|image|max:2048',
            'cat_id' => 'required|exists:cats,id'
        ]);
        $skill = Skill::findOrFail($request->id);
        $path = $skill->img;
        if($request->hasFile('img')) {
            Storage::delete($path);
            $path = Storage::putFile("skills", $request->file('img'));
        }
        $skill->update([
            'name'=> json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'img' => $path,
            'cat_id' =>$request->cat_id,
        ]);
        $request->session()->flash('msgAdmin','you success you edited one row ');

        return back();
    }
    public function delete($id ,Request $request) {
        $oSkil = Skill::findOrFail($id);
        if($oSkil->exams->count() > 0){
            $request->session()->flash('msgAdmin','this skill has exams you mustnt deleted');
            return back();
        }
        $path = $oSkil->img;
        Storage::delete($path);
        $oSkil->delete();
        return back();
    }
    public function toggal($id, Request $request) {
        $oSkill = Skill::findOrFail($id);
        $oSkill->update([
            'active' => ! $oSkill->active,
        ]);
        if($oSkill->active) {
            $request->session()->flash('msgAdmin','this skill active ');
        } else {
            $request->session()->flash('msgAdmin','this skill not active ');
        }
        return back();
    }

}
