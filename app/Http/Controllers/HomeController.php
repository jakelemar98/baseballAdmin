<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if(Auth::user()){
        $route = view('home');
      } else {
        $route = redirect('/');
      }
        return $route;
    }

    public function checkAccess(){
      if (Auth::user()) {
        if (Auth::user()->admin) {
          $view = redirect('admin');
        }else {
          $view = view('home');
        }
      } else {
        $view = view('auth.login');
      }

      return $view;
    }
}
