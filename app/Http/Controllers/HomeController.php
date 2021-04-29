<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Alert;
use Auth;
use App\CargaHoraria;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Alert::success('Bienvenido', Auth::user()->dni);
        
        $dni =  Auth::user()->dni;
        
        $ciclos = CargaHoraria::whereNotNull('grupo_id')->where('profesor_id',  $dni)->distinct()->pluck("grupo_id", "grupo_id");
        
        $ciclos_no = CargaHoraria::whereNotNull('grupo_id')
            ->where('profesor_id', '!=' , $dni)
            ->where('grupo_id', '!=', '_OC')
            ->where('grupo_id', '!=', '_JD')
            ->where('grupo_id', '!=', '_EN')
            ->where('grupo_id', '!=', '_CD')->distinct()->pluck("grupo_id", "grupo_id");
            
        return view('home',compact('ciclos', 'ciclos_no'));
    }
}