<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drug;
use DB;

class ReportController extends Controller
{
    public function getWhoMoreExpend()
    {
        try
        {
            $data = Drug::select('people.name', DB::raw('sum(drugs.price) as value'))
            ->join('people', 'people.id', 'drugs.person_id')
            ->groupby('people.name')
            ->orderby(DB::raw('sum(drugs.price)'),'desc')
            ->get();
            return response(['message' => 'Relatório montado com sucesso.', 'data' => $data], 200);
        }catch(\Exception $e){
            return response(['message' => $e->getMessage()], 500);
        }
    }

    public function getMoreUsedDrugs()
    {
        try
        {
            $data = Drug::select('name', DB::raw('count(name) as amount'))
            ->groupby('name')
            ->get();
            return response(['message' => 'Relatório montado com sucesso.', 'data' => $data], 200);
        }catch(\Exception $e){
            return response(['message' => $e->getMessage()], 500);
        }
    }

    public function getPeopleUseSameDrugs()
    {
        try
        {
            $data = Drug::select('name')->distinct()->get();
            foreach($data as $d)
            {
                $people = Drug::select('drugs.person_id', 'people.name')
                ->join('people', 'people.id', 'drugs.person_id')
                ->where('drugs.name', $d->name)
                ->get();
                $d['people'] = $people;
            }
            return response(['message' => 'Relatório montado com sucesso.', 'data' => $data], 200);
        }catch(\Exception $e){
            return response(['message' => $e->getMessage()], 500);
        }
    }
}
