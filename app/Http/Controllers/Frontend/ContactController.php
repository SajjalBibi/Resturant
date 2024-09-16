<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactModel;


class ContactController extends Controller
{
    //
    public function create()
    {
        $con=ContactModel::all();
        return view('Frontend.contactus',compact('con'));
    } 
    public function store(Request $request)
    {
        $con= new ContactModel();

        $con->name = $request-> name;
        $con->email = $request-> email;
        $con->phone = $request-> phone;
        $con->msg = $request-> msg;   
        $con->save();
        return redirect()->back()->with('success', 'Message sent successfully!');

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone'=>'required',
            'msg' => 'required|min:10'
            
        ]);
    }
    public function show()
    {
        $con=ContactModel::all();
        return view('dashboard.contact',compact('con'));


    }
  
}

