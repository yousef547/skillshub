<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Massage;
use App\Models\satting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
   public function contact(){
       $data['satt'] = satting::select('email','phone')->first();
       return view('web.contact.index')->with($data);
   }
  
   public function send(Request $request)
   {
       $request->validate([
           'name' => 'required|string|max:255',
           'email' => 'required|email|max:255',
           'subject' => 'nullable|string|max:255',
           'body' => 'required|string',
       ]);

       Massage::create([
           'name' => $request->name,
           'email' => $request->email,
           'subject' => $request->subject,
           'body' => $request->body,
       ]);

       $data = ['success' => 'your message sent successfully'];
       return Response::json($data);
   }
//    public function send(Request $request){
//     // $validator=Validator::make($request->all(),[
//     //     'name'=>'required|string|max:255',
//     //     'email'=>'required|email|max:255',
//     //     'subject'=>'nullable|string|max:255',
//     //     'body'=>'required|string',
//     // ]);
//     // if ($validator->fails()){
//     //     $errors = $validator->errors();
//     //     return Response::json($errors);
//     // }
//     $request->validate([
//         'name'=>'required|string|max:255',
//         'email'=>'required|email|max:255',
//         'subject'=>'nullable|string|max:255',
//         'body'=>'required|string',
//     ]);
   

//     Massage::create([
//         'name'=> $request->name,
//         'email'=>$request->email,
//         'subject'=>$request->subject,
//         'body'=>$request->subject,
//     ]);
//     $data = ['success' => 'your massage send successfully'];
//     return Response::json($data);

//    }
}
