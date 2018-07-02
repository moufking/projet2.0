<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class ProfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if(Auth::user()->type="freelance")
        {
            $id=Auth::user()->id;
            $pseudo=Auth::user()->name;
            $email=Auth::user()->email;
            $phone=Auth::user()->phone;
            $email=Auth::user()->email;
            $type=Auth::user()->type;
            $secteur=Auth::user()->secteur;
            $photo=Auth::user()->image;
            $ville=Auth::user()->ville;

            return view('profil.profil',compact('id','pseudo','email','phone','secteur','photo','ville'));
        }else
        {
            $id=Auth::user()->id;
            $pseudo=Auth::user()->name;
            $email=Auth::user()->email;
            $phone=Auth::user()->phone;
            $email=Auth::user()->email;
            $company=Auth::user()->company;
            $type=Auth::user()->type;
            $secteur=Auth::user()->secteur;
            $photo=Auth::user()->image;
            $ville=Auth::user()->ville;
            return view('profil.profil',compact('id','pseudo','email','company','phone','secteur','photo','ville'));

        }




    }
    public function freelance()
    {
        return view('profil.all_projet');
    }
    public function poster()
    {
        $id=Auth::user()->id;
        $pseudo=Auth::user()->name;
        $email=Auth::user()->email;
        $phone=Auth::user()->phone;
        $email=Auth::user()->email;
        $type=Auth::user()->type;
        $secteur=Auth::user()->secteur;
        return view('profil.edit_projet',compact('id','pseudo','email','phone','secteur'));
    }
    public function edit($id,Request $request)
    {

        $inputs= Input::all();
        $validation =Validator::make($inputs,[
            'ville' => 'required',
            'image' => 'required',

        ]);
        if($validation->fails())
        {
            return Redirect::back()->withErrors($validation);
        }else
        {
            $user=User::find($id);
            $user->ville=$request->input('ville');
            $file =Input::file('image');
            $fil=  $file->move('uploads_users', $file->getClientOriginalName());
            $user->image=($fil);
            $user->save();
            return Redirect::back()->with('success',"Vos données viennent d'etre mis à jour");

        }





    }

}
