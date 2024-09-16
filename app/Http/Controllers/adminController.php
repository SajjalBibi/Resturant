<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use App\Models\user;
 use App\Models\Category;


class adminController extends Controller
{
 
    //
    public function adminhome(){
        $cat=Category::all();
        return view('dashboard.index' ,compact('cat'));
    }

    public function user(){
        $data=user::all();
        return view("dashboard.users",compact("data"));
    }

    public function deleteuser($id){
        $data=user::find($id);
        $data->delete();
        return redirect()->back();
    }
}
