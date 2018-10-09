<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\players;
use App\fileUploads;


class HitTraxController extends Controller
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

    public function add(Request $request)
    {
      if ($request->hasFile('files')) {

        $file = $request->file('files');

        if (count($file) == 1) {
          $file = $file[0];
        }

        if ($request->name == '0') {

          $fileName = "at-bats-report.";

          $fileExt = $file->getClientOriginalExtension();

          $fileName = $fileName.$fileExt;

        } elseif ($request->name == 'multiples') {

          foreach ($file as $curFile) {

            $name = pathinfo($curFile->getClientOriginalName(), PATHINFO_FILENAME);

            $player = players::where('last_name', $name)->first();

            $fileName = $player->first_name.'-'.$player->last_name.'-'.$player->id.'.';

            $fileExt = $curFile->getClientOriginalExtension();

            $fileName = $fileName.$fileExt;

            $uplaodPath = 'uploads';
            $curFile->move($uplaodPath, $fileName);

            fileUploads::where('player_id', '=', $player->id)->delete();
            $fileUpload = new fileUploads;
            $fileUpload->player_id = $player->id;
            $fileUpload->file_name = $fileName;
            $fileUpload->save();

          }

          return redirect('admin/hitTrax');

        } else {

          $player = players::find($request->name);

          $fileName = $player->first_name.'-'.$player->last_name.'-'.$request->name.'.';

          $fileExt = $file->getClientOriginalExtension();

          $fileName = $fileName.$fileExt;

        }

        $uplaodPath = 'uploads';
        $file->move($uplaodPath, $fileName);

        fileUploads::where('player_id', '=', $request->name)->delete();

        $fileUpload = new fileUploads;
        if ($request->name == '0') {
          $fileUpload->id = 6969;
        }

        $fileUpload->player_id = $request->name;
        $fileUpload->file_name = $fileName;
        $fileUpload->save();

        return redirect('admin/hitTrax');
      }

    }

    public function createReport(){
      $files = fileUploads::all();

      $files = $files->filter(function($item){
        return $item->player_id > 0;
      });

      foreach ($files as $file) {
        $id = $file->player_id;
        $player = players::find($id);
        $nameArr[$player->id] = $player->first_name." ".$player->last_name;

        $filename = "uploads/".$file->file_name;

        $csvFile = file($filename);

        $ptsTotal = 0;

        for ($i=0; $i < count($csvFile); $i++) {
          $line = str_getcsv($csvFile[$i]);
          $points = intval($line[2]);
          $ptsTotal = $ptsTotal + $points;
        }
        $ptVals[$file->player_id][0] = $file->player_id;
        $ptVals[$file->player_id][1] = $ptsTotal;
      }

      $atBatFile = fileUploads::find(6969);
      $filename = "uploads/".$atBatFile->file_name;
      $csvFile = file($filename);

      $atBatArr = [];

      for ($i=0; $i < count($csvFile); $i++) {
        $line = str_getcsv($csvFile[$i]);
        $name = $line[0];
        $names = explode(" ", $name);
        $first = $names[0];
        $last = $names[1];

        $currentPlayer = DB::table('players')->where('last_name', $last)->pluck('id');

        $currentId = $currentPlayer[0];
        $atBatArr[$currentId] = $line[4];
      }

      $data = [
        'ptVals' => $ptVals,
        'names' => $nameArr,
        'atBats' => $atBatArr
      ];


      return view('admin.hitTraxReport')->with('data', $data);
    }

    public function downloadFile($file){
      $file_path = public_path('uploads/'.$file);
      return response()->download($file_path);
    }
}
