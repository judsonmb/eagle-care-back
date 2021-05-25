<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drug;
use App\Models\Schedule;
use App\Http\Requests\DrugStoreRequest;
use App\Http\Requests\DrugUpdateRequest;
use DB;

class DrugController extends Controller
{
    /**
     * Calls the Drug's model and returns a list of drugs with its relations.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            $data = Drug::getIndexData();
            return response(['data' => $data], 200);
        }catch(\Exception $e)
        {
            return response(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created Drug in storage.
     * 
     * Store the correspondent schedules. 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DrugStoreRequest $request)
    {
        try
        {
            $form = $request->all();
            $form['name'] = strtoupper($form['name']);
            $drugData = Drug::create($form);
            $scheduleData = Schedule::storeDrugSchedules($drugData->id, $drugData->period, 
            $drugData->interval, $drugData->created_at);

            if(!$drugData || !$scheduleData)
            {
                return response(['message' => 'Um erro ocorreu. Contate o suporte.'], 500);
            }
            return response(['message' => 'Medicamento cadastrado com sucesso!','data' => $drugData], 200);
        }
        catch(\Exception $e)
        {
            return response(['message' => 'Um erro ocorreu. Contate o suporte.'], 500);
        }
    }

     /**
     * Remove the specified resource from storage.
     * 
     * Remove the correspondent schedules.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $drug = Drug::find($id);
            if(!$drug){
                return response(['message' => 'Medicamento não encontrado.'], 404);
            }
            $drug->delete();
            return response(['message' => 'Medicamento deletado com sucesso!'], 200);
        }
        catch(\Exception $e)
        {
            return response(['message' => 'Um erro ocorreu. Contate o suporte.'], 500);
        }
    }

    /**
     * Get the ranking of people who more expend with drugs.
     */
    public function getWhoMoreExpend()
    {
        try
        {
            $data = Drug::getWhoMoreExpend();
            return response(['message' => 'Relatório montado com sucesso.', 'data' => $data], 200);
        }catch(\Exception $e){
            return response(['message' => $e->getMessage()], 500);
        }
    }

     /**
     * Get the ranking of more used drugs.
     */
    public function getMoreUsedDrugs()
    {
        try
        {
            $data = Drug::getMoreUsedDrugs();
            return response(['message' => 'Relatório montado com sucesso.', 'data' => $data], 200);
        }catch(\Exception $e){
            return response(['message' => $e->getMessage()], 500);
        }
    }

     /**
     * Get the ranking of people who use same drugs.
     */
    public function getPeopleUseSameDrugs()
    {
        try
        {
            $data = Drug::getPeopleUseSameDrugs();
            return response(['message' => 'Relatório montado com sucesso.', 'data' => $data], 200);
        }catch(\Exception $e){
            return response(['message' => $e->getMessage()], 500);
        }
    }
}
