<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'created_at', 
        'updated_at',
        'email_verified_at'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected function login(Array $input)
    {
        $data = Array();

        if(Auth::attempt(['email' => $input['email'], 'password' => $input['password']])){ 
            $user = Auth::user(); 
            $data['token'] = $user->createToken('MyApp')-> accessToken; 
            $data['id'] = $user->id;
            $data['name'] = $user->name;
        } 
        
        return $data;
    }

    protected function store(Array $input)
    {
        $input['name'] = ucwords($input['name']);
        $input['email'] = strtolower($input['email']);
        $input['password'] = bcrypt($input['password']);
        $user = $this->create($input);
        $data['token'] =  $user->createToken('MyApp')->accessToken;
        $data['name'] =  $user->name;

        return $data;
    }
}
