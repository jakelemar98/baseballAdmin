<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
  public function show()
  {
    if (Auth::user()) {
      if (Auth::user()->admin) {
        $players = DB::table('players')->orderBy('position')->get();
        $view = view('admin.welcome')->with('players',$players);
      }else {
        $view = view('home');
      }
    } else {
      $view = redirect('/');
    }

    return $view;
  }
}
