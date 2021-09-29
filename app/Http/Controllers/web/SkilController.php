<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkilController extends Controller
{
    public function show($id){
        $date['skill'] = Skill::findOrFail($id);
        // dd($date);
        return view('web.skill.show')->with($date);
    }
}
