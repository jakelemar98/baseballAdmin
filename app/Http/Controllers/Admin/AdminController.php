<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\practices;
use App\fileUploads;
use App\players;


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

  public function showHitTrax(){

    $players = players::all();

    $players = $players->filter(function ($item){
      return $item->id > 0;
    });

    $files = fileUploads::all();

    $files = $files->filter(function ($item){
      return $item->player_id > 0;
    });

    $nameArr = [];

    foreach ($files as $file) {
      $id = $file->player_id;
      if ($id > 0) {
        $player = players::find($id);
        $nameArr[$player->id] = $player->first_name." ".$player->last_name;
      }
    }

    $atBatFile = fileUploads::find(6969);

    $data = [
      'players' => $players,
      'files' => $files,
      'names' => $nameArr,
      'atBats' => $atBatFile
    ];
    return view('admin.hitTrax')->with('data', $data);
  }

  public function showLineup(){
    return view('admin.lineup');
  }
}
