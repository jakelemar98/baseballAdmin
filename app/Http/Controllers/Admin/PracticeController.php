<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\practices;
use App\practiceEvents;


class PracticeController extends Controller
{
    public function addPractice(Request $request){
      $name = $request->name;
      $date = $request->date;
      $start = $request->startTime;
      $end = $request->endTime;
      $interval = $request->interval;

      $practice = new practices;

      $practice->practice_name = $name;
      $practice->practice_date = $date;
      $practice->start_time = $start;
      $practice->end_time = $end;
      $practice->interval = $interval;

      $practice->save();

      $practiceId = $practice->practice_id;

      $startTimeArr = $request->start;
      $endTimeArr = $request->end;
      $events = $request->event;

      $length = count($startTimeArr);

      $amOrPm = substr($startTimeArr[0], -2);

      if ($amOrPm == 'PM') {
        for ($i=0; $i < $length ; $i++) {
          $startHour = substr($startTimeArr[$i], 0, 1);
          $restOfStart = substr($startTimeArr[$i], 1, 3);

          $endHour = substr($endTimeArr[$i], 0, 1);
          $restOfEnd = substr($endTimeArr[$i], 1, 3);

          $startHour = $startHour + 12;
          $endHour = $endHour + 12;

          $startTimeArr[$i] = $startHour . $restOfStart;
          $endTimeArr[$i] = $endHour . $restOfEnd;
        }
      }

      for ($i=0; $i < $length; $i++) {
        $practiceEvent = new practiceEvents;
        $practiceEvent->practice_id = $practiceId;
        $practiceEvent->event_start = $startTimeArr[$i];
        $practiceEvent->event_end = $endTimeArr[$i];
        $practiceEvent->event_name = $events[$i];

        $practiceEvent->save();
      }

      return redirect('/admin/practice');
    }

    public function getPractice($id){
      $practice = practices::find($id);

      $practiceId = $practice->practice_id;

      $events = practiceEvents::where('practice_id', $practiceId)->get();

      $returnArr = [$practice, $events];

      return $returnArr;
    }

    public function updatePractice(Request $request){
      $name = $request->name;
      $date = $request->date;
      $start = $request->startTime;
      $end = $request->endTime;
      $interval = $request->interval;
      $practiceId = $request->id;

      practices::where('practice_id', $practiceId)->update([
        'practice_name' => $name,
        'practice_date' => $date,
        'start_time' => $start,
        'end_time' => $end,
        'interval' => $interval,
        'updated_at' => now()
      ]);

      $startTimeArr = $request->start;
      $endTimeArr = $request->end;
      $events = $request->event;
      $eventsId = $request->eventId;

      $length = count($startTimeArr);

      for ($i=0; $i < $length; $i++) {
        $eventId = $eventsId[$i];
        practiceEvents::where('id', $eventId)->update([
          "practice_id" => $practiceId,
          "event_start" => $startTimeArr[$i],
          "event_end" => $endTimeArr[$i],
          "event_name" => $events[$i],
          "updated_at" => now()
        ]);
      }

      return redirect('/admin/practice');
    }

    public function deletePractice(Request $request){
      $id = $request->id;

      $practiceEvents = practiceEvents::where('practice_id', $id);

      $practiceEvents->delete();


      $practices = practices::find($id);

      $practices->delete();

      return redirect('/admin/practice');
    }
}
