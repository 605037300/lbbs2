<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Topic;

class CategoriesController extends Controller
{
    //

    public function __construct(){

    }

    public function show(Category $category,Request $request){
       $topics= Topic::withOrder($request->order)->where('category_id',$category->id)->paginate(20);
       return view('topics.index',compact(['category','topics']));
    }
}
