<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function index()
    {
        try
        {
            $data = Schedule::with('drug.person')
            ->where('schedule', '>=', date('Y-m-d H:i:s'))
            ->orderby('schedule')
            ->get();
            return response(['data' => $data], 200);
        }catch(\Exception $e)
        {
            return response(['message' => $e->getMessage()], 500);
        }
    }
}
