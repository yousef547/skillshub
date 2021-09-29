<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CatResource;
use App\Models\Cat;
use Illuminate\Http\Request;

class CatController extends Controller
{
    public function index(){
        return CatResource::collection(Cat::get());
    }
    public function show($id){
        $cat = Cat::with('skills')->find($id);
        if($cat == null) {
            return response()->json([
                'msg'=>'not found id',
            ]);
        }
        return new CatResource($cat);
    }
}
