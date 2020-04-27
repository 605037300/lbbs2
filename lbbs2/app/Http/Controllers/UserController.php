<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Handlers\UploadImageHandler;
use Illuminate\Support\Facades\Gate;
class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth',['except'=>['show']]);
    }

    //
    public function  show(User $user){
        $this->authorize('update',$user);
        return view('users.show',compact('user'));
    }

    public function  edit(User $user){
        $this->authorize('update',$user);
        return view('users.edit',compact('user'));
    }

    public  function  update(UserRequest $request,UploadImageHandler $upload,User $user){
       
        // dd(class_basename('App\Http\Controllers'));
        // dd($request->avator);
        // dd(\Str::random(10));
        // dd(public_path());
        // dd(date('Y/m/d',time()));
        $alldata=$request->all();

        // if($request->avator){
        //     $result=$upload->save($request->avator,'avator',$user->id);
        //     $alldata['avator']=$result['path'];
        // }

        if($request->avator){
            $result=$upload->save($request->avator,'avator',$user->id,212);
            $alldata['avator']=$result['path'];
        }


        $user->update($alldata);
        return redirect()->route('users.show',$user->id)->with('success','个人资料更新成功');
    }


}
