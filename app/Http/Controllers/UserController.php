<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(UserLoginRequest $request)
    {
        try{
            $data = User::login($request->all());
            if(empty($data))
            {
                return response(['message' => 'E-mail e senha não conferem.'], 401);
            }
            return response(['data' => $data], 200);
        }
        catch(\Exception $e)
        {
            return response(['message' => 'Um erro ocorreu. Contate o suporte.'], 500);
        }
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            $data = User::orderby('name')->get();
            return response(['data' => $data], 200);
        }catch(\Exception $e)
        {
            return response(['message' => 'Um erro ocorreu. Contate o suporte.'], 500);
        }
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        try
        {
            $data = User::store($request->all());
            return response(['message' => 'Usuário cadastrado com sucesso!','data' => $data], 200);
        }
        catch(\Exception $e)
        {
            return response(['message' => 'Um erro ocorreu. Contate o suporte.'], 500);
        }
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
            $data = User::find($id);
            if(!$data){
                return response(['message' => 'Usuário não encontrado.'], 404);
            }
            return response(['message' => 'Usuário encontrado com sucesso.', 'data' => $data], 200);
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
    public function update(UserUpdateRequest $request, $id)
    {
        try
        {
            $data = User::where('id', $id)->update(['name' => ucwords($request->input('name'))]);
            if(!$data){
                return response(['message' => 'Usuário não encontrado.'], 404);
            }
            return response(['message' => 'Usuário editado com sucesso!'], 200);
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
            $user = User::find($id);
            if(!$user){
                return response(['message' => 'Usuário não encontrado.'], 404);
            }
            $user->delete();
            return response(['message' => 'Usuário deletado com sucesso!'], 200);
        }
        catch(\Exception $e)
        {
            return response(['message' => 'Um erro ocorreu. Contate o suporte.'], 500);
        }
    }
}
