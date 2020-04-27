<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //
    public function root(Request $request)
    {
//        redirect()->route('verification.notice');
//        dd(\Auth::user()->hasVerifiedEmail());
          return view('pages.root');
    }

}
