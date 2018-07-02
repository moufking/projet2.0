<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProjetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $inputs=Input::all();
        return dd($inputs);
        $inputs['email']= e($inputs['email']);
        $inputs['phone'] =e($inputs['phone']);
        $inputs['ville'] =e($inputs['ville']);
        $inputs['name_projet'] =e($inputs['name_projet']);
        $inputs['projet'] =e($inputs['projet']);
        $inputs['date'] =e($inputs['date']);
        $inputs['jour'] =e($inputs['jour']);
        $inputs['budget'] =e($inputs['budget']);
        $inputs['description'] =e($inputs['description']);
        $inputs['secteur'] =e($inputs['secteur']);
        $inputs['id_user'] =e($inputs['id_user']);

        $validation = validator::make($inputs,[
            'email'=>'required|min:3|unique:users',
            'phone'=>'required|min:8|max:8',
            'villle'=>'required',
            'name_projet'=>'required',
            'projet'=>'required',
            'date'=>'required',
            'jour'=>'required',
            'budget'=>'required',
            'description'=>'required',
            'secteur'=>'required',
            'id_user'=>'required',

        ]);

        if($validation->fails())
        {
            return view('profil.edit_projet')->withErrors($validation);
        }else
        {
            $user= Projet::create([
                'email'=>$inputs['email'],
                'phone'=>$inputs['phone'],
                'ville'=>$inputs['ville'],
                'name_projet'=>$inputs['name_projet'],
                'projet'=>$inputs['projet'],
                'date'=>$inputs['date'],
                'jour'=>$inputs['jour'],
                'budget'=>$inputs['budget'],
                'description'=>$inputs['description'],
                'secteur'=>$inputs['secteur'],
                'id_user'=>$inputs['d_user'],
            ]);
        }


    }

}
