<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class webController extends Controller
{
    //

  
    public function web()
    {
        $menus = Menu::all();
        $categories = Category::all();
        return view('Frontend.web.index',compact('menus','categories'));
    }
  


    
}
