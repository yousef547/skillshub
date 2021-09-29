<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use Illuminate\Http\Request;

class CatController extends Controller
{
    public function index(){
        $data['cats'] = Cat::orderBy('id','DESC')->paginate(10);
        return view('admin.cat.index')->with($data);
    }
    public function store(Request $request) {
        $request->validate([
            'name_en'=> 'required|string|max:50',
            'name_ar'=> 'required|string|max:50',

        ]);
        Cat::create([
            'name'=> json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ])
        ]);
        $request->session()->flash('msgAdmin','you success you add one row ');

        return back();
    }
    public function updata(Request $request) {
        // dd($request->all());
        $request->validate([
            'id' => 'required|exists:cats,id',
            'name_en'=> 'required|string|max:50',
            'name_ar'=> 'required|string|max:50',

        ]);
        Cat::findOrFail($request->id)->update([
            'name'=> json_encode([   
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ])
        ]);
        $request->session()->flash('msgAdmin','you success you edited one row ');

        return back();
    }
    public function delete($id ,Request $request) {
        $oCat = Cat::findOrFail($id);
        if($oCat->skills->count() > 0){
            $request->session()->flash('msgAdmin','this caategory has skille you mustnt deleted');
            return back();
        }
        $oCat->delete();
        return back();
    }
    public function toggal($id, Request $request) {
        $oCat = Cat::findOrFail($id);
        $oCat->update([
            'active' => ! $oCat->active,
        ]);
        if($oCat->active) {
            $request->session()->flash('msgAdmin','this caategory active ');
        } else {
            $request->session()->flash('msgAdmin','this caategory not active ');
        }
        return back();
    }
}
