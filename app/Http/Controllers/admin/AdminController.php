<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

class AdminController extends Controller
{
    public function index(){
        $suberAdminRole= Role::where('name','suberadmin')->first();
        $adminRole= Role::where('name','admin')->first();
        $data['admins']=User::whereIn('role_id',[$suberAdminRole->id,$adminRole->id])
        ->orderBy('id','DESC')
        ->paginate(10);
        return view('admin.admins.index')->with($data);
    }
    public function create(){
        $data['roles']=Role::select('id','name')->whereIn('name',['suberadmin','admin'])->get();
        return view('admin.admins.create')->with($data);
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:5|max:25|confirmed',
            'role_id' => 'required|exists:roles,id'
        ]);
        // $newUser['valid']= Hash::make($request->password);
        $user= User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);
        event(new Registered($user));
        return redirect(url('dashboard/admins'));
    }
    public function promote($id){
    $user=User::findOrFail($id);
       $user->update([
           'role_id' => Role::select('id')->where('name','suberadmin')->first()->id,
       ]);
       return back();
    }
    public function demote($id){
        $user=User::findOrFail($id);
        $user->update([
            'role_id' => Role::select('id')->where('name','suberadmin')->first()->id,
        ]);
        return back();
    }
}
