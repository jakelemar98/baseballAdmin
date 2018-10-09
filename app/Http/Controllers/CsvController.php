<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CsvController extends Controller
{
    public function read(){
      $csvFile = file('data.csv');
      $data = [];
      foreach ($csvFile as $line) {
          $data[] = str_getcsv($line);
      }
    $ptsTotal = 0;
    for ($i=0; $i < count($data); $i++) {
      $points = intval($data[$i][2]);
      $ptsTotal = $ptsTotal + $points;
    }
    dd($ptsTotal);
  }
}
