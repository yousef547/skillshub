<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SkillResource;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    public function show($id){
        $skill = Skill::with('exams')->find($id);
        if($skill == null){
            return response()->json([
                'msg'=> 'not found Skill',
            ]);
        }
        return new SkillResource($skill);
    }
}
