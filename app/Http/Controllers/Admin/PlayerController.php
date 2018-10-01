<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\players;

class PlayerController extends Controller
{
    public function addPlayer(Request $request) {
      $posArr = ['P' => 1, 'C' => 2, '1B' => 3, '2B' => 4, '3B' => 5, 'SS' => 6, 'LF' => 7, 'CF' => 8, 'RF' => 9];
      $fname = $request->firstname;
      $lname = $request->lastname;
      $position = $request->position;
      $position = $posArr[$position];
      $eligyear = $request->eligyear;

      DB::table('players')->insert(
          ['first_name' => $fname, 'last_name' => $lname, 'position' => $position, 'elig_year' => $eligyear, 'created_at' => now()]
      );
      return redirect()->route('players');
    }

    public function getPlayer($id){
      $userInfo = players::find($id);
      return $userInfo;
    }

    public function updatePlayer(Request $request) {
      $posArr = ['P' => 1, 'C' => 2, '1B' => 3, '2B' => 4, '3B' => 5, 'SS' => 6, 'LF' => 7, 'CF' => 8, 'RF' => 9];
      $id = $request->id;
      $fname = $request->firstname;
      $lname = $request->lastname;
      $position = $request->position;
      $position = $posArr[$position];
      $eligyear = $request->eligyear;
      players::where('id', $id)->update([
        'first_name' => $fname,
        'last_name' => $lname,
        'position' => $position,
        'elig_year' => $eligyear
      ]);

      return redirect('/admin/players');
    }

    public function deletePlayer(Request $request){
      $id = $request->id;
      $players = players::find($id);
      $players->delete();

      return redirect('/admin/players');
    }
}
