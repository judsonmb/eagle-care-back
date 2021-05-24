<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
     /**
     * Calls the Schedule's model and returns a list of schedules with its relations.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            $data = Schedule::getOrderedSchedulesAndRelations();
            return response(['data' => $data], 200);
        }catch(\Exception $e)
        {
            return response(['message' => 'Um erro ocorreu. Contate o suporte.'], 500);
        }
    }
}
