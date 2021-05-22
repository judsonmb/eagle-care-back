<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drug;
use App\Http\Requests\DrugStoreRequest;
use App\Http\Requests\DrugUpdateRequest;

class DrugController extends Controller
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
            $data = Drug::with('schedule')->with('person')->orderby('name')->get();
            return response(['data' => $data], 200);
        }catch(\Exception $e)
        {
            return response(['message' => 'Um erro ocorreu. Contate o suporte.'], 500);
        }
    }

    /**
     * Store a newly created Drug in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DrugStoreRequest $request)
    {
        try
        {
            $data = Drug::create($request->all());
            return response(['message' => 'Medicamento cadastrado com sucesso!','data' => $data], 200);
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
            $data = Drug::find($id);
            if(!$data){
                return response(['message' => 'Medicamento não encontrado.'], 404);
            }
            return response(['message' => 'Medicamento encontrado com sucesso.', 'data' => $data], 200);
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
    public function update(DrugUpdateRequest $request, $id)
    {
        try
        {
            $data = Drug::where('id', $id)->update($request->all());
            if(!$data){
                return response(['message' => 'Medicamento não encontrado.'], 404);
            }
            return response(['message' => 'Medicamento editado com sucesso!'], 200);
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
            $Drug = Drug::find($id);
            if(!$Drug){
                return response(['message' => 'Medicamento não encontrado.'], 404);
            }
            $Drug->delete();
            return response(['message' => 'Medicamento deletado com sucesso!'], 200);
        }
        catch(\Exception $e)
        {
            return response(['message' => 'Um erro ocorreu. Contate o suporte.'], 500);
        }
    }
}
