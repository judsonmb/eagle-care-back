<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Http\Requests\ScheduleStoreRequest;
use App\Http\Requests\ScheduleUpdateRequest;
use Illuminate\Database\QueryException;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            $data = Schedule::orderby('id')->get();
            return response(['data' => $data], 200);
        }catch(\Exception $e)
        {
            return response(['message' => 'Um erro ocorreu. Contate o suporte.'], 500);
        }
    }

    /**
     * Store a newly created Schedule in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleStoreRequest $request)
    {
        try
        {
            Schedule::create($request->all());
            return response(['message' => 'Horário cadastrado com sucesso!'], 200);
        }
        catch(\Exception $e)
        {
            return response(['message' => 'Um erro ocorreu. Contate o suporte.'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try
        {
            $data = Schedule::find($id);
            if(!$data){
                return response(['message' => 'Horário não encontrado.'], 404);
            }
            return response(['message' => 'Horário encontrado com sucesso.', 'data' => $data], 200);
        }catch(\Exception $e){
            return response(['message' => 'Um erro ocorreu. Contate o suporte.'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ScheduleUpdateRequest $request, $id)
    {
        try
        {
            $data = Schedule::where('id', $id)->update($request->all());
            if(!$data){
                return response(['message' => 'Horário não encontrado.'], 404);
            }
            return response(['message' => 'Horário editado com sucesso!'], 200);
        }
        catch(\Exception $e)
        {
            return response(['message' => 'Um erro ocorreu. Contate o suporte.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $schedule = Schedule::find($id);
            if(!$schedule){
                return response(['message' => 'Horário não encontrado.'], 404);
            }
            $schedule->delete();
            return response(['message' => 'Horário deletado com sucesso!'], 200);
        }
        catch(\Exception $e)
        {
            return response(['message' => 'Um erro ocorreu. Contate o suporte.'], 500);
        }
    }
}
