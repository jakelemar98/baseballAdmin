<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\practices;


class AdminController extends Controller
{
  public function __construct()
  {
    $this->middleware(function ($request, $next) {
        $admin = Auth::user()->admin;
        if (!$admin) {
          return redirect(route('login'));
        }
        return $next($request);
    });


  }

  public function index(){
    return view('admin.index');
  }

  public function showPlayers()
  {
    $players = DB::table('players')->orderBy('position')->get();
    return view('admin.players')->with('players',$players);
  }

  public function showPractice()
  {
    $practices = practices::all();
    return view('admin.practice')->with('practices', $practices);
  }
}
