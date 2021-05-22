<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Http\Requests\PersonStoreRequest;
use App\Http\Requests\PersonUpdateRequest;
use Illuminate\Database\QueryException;

class PersonController extends Controller
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
            $data = Person::orderby('name')->get();
            return response(['data' => $data], 200);
        }catch(\Exception $e)
        {
            return response(['message' => 'Um erro ocorreu. Contate o suporte.'], 500);
        }
    }

    /**
     * Store a newly created Person in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonStoreRequest $request)
    {
        try
        {
            $data = Person::create($request->all());
            return response(['message' => 'Pessoa cadastrada com sucesso!','data' => $data], 200);
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
            $data = Person::find($id);
            if(!$data){
                return response(['message' => 'Pessoa não encontrada.'], 404);
            }
            return response(['message' => 'Pessoa encontrada com sucesso.', 'data' => $data], 200);
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
    public function update(PersonUpdateRequest $request, $id)
    {
        try
        {
            $data = Person::where('id', $id)->update(['name' => ucwords($request->input('name'))]);
            if(!$data){
                return response(['message' => 'Pessoa não encontrado.'], 404);
            }
            return response(['message' => 'Pessoa editado com sucesso!'], 200);
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
            $Person = Person::find($id);
            if(!$Person){
                return response(['message' => 'Pessoa não encontrada.'], 404);
            }
            $Person->delete();
            return response(['message' => 'Pessoa deletada com sucesso!'], 200);
        }
        catch(\Exception $e)
        {
            return response(['message' => 'Um erro ocorreu. Contate o suporte.'], 500);
        }
    }
}
