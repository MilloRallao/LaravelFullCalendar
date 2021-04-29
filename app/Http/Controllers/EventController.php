<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Auth;
use Validator;
use App\Event;
use Carbon\Carbon;
use App\CargaHoraria;
use App\Franja;

use Calendar;
use Input;
use Alert;

class EventController extends Controller{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }
    
    protected $redirectTo = '/home';

    public function get_events(Request $request){
        $events = Event::select('id', 'event_name as title', 'start_date as start', 'end_date as end', 'all_day', 'color')->where('ciclo_id', 'like' , "%$request->ciclo%")->where('user_id', Auth::user()->id)->get()->toArray();
        for($i = 0; $i<count($events); $i++){
            $events[$i]['allDay'] = $events[$i]['all_day'];
        }
        return response()->json($events);
    }
    
    public function index(Request $request){
        
        $modulos = CargaHoraria::where('grupo_id', $request->ciclo)->where('profesor_id', Auth::user()->dni)->distinct()->get();
        $franjas = Franja::all();
        
        return view('events',compact('modulos', 'franjas', 'request'));
    }
    
    public function get_other_events(Request $request){
        $events = Event::select('id', 'event_name as title', 'start_date as start', 'end_date as end', 'all_day as allDay', 'color')->where('ciclo_id', 'like' , "%$request->ciclo%")->where('user_id', '!=', Auth::user()->id)->get()->toArray();
        return response()->json($events);
    }
    
    public function otrosIndex(Request $request){
        $modulos = CargaHoraria::where('grupo_id', $request->ciclo_no)->distinct()->get();
        
        $eventos = Event::where('id', '!=', Auth::user()->id)->get();
        
        return view('otrosEvents',compact('modulos', 'request', 'eventos'));
    }
    
    public function update_events(Request $request){
        $start=str_replace('T', ' ', $request->start);
        $f_i = Carbon::createFromFormat('Y-m-d H:i:s', $start);
        $param['start_date'] = $f_i;
        
        $end=str_replace('T', ' ',$request->ended);
        $f_e = Carbon::createFromFormat('Y-m-d H:i:s', $end);
        $param['end_date'] = $f_e;
        
        $event=Event::findOrFail($request->id);
        
        $r = $event->update($param);
        
        return response()->json($r);
    }

    public function store(Request $request){
        
        $note = $request->input('all_day_falso');
        
        if($note == 1){
            $validatedData = [
                'note_name' => 'required',
            ];
            
            $messages = [
                'note_name.required' => 'No se ha puesto ningún título.',
            ];
        }else{
            $validatedData = [
                'event_name' => 'required',
                'start_date' => 'required',
                'h_inicial' => 'required',
                'h_final' => 'required'
            ];
            
            $messages = [
                'event_name.required' => 'No se ha elegido ningún módulo.',
                'start_date.required' => 'No se ha elegido una fecha.',
                'h_inicial.required' => 'No se ha elegido una hora de inicio',
                'h_final.required' => 'No se ha elegido una hora de fin',
            ];
        }
        
        $this->validate($request, $validatedData, $messages);
        
        $evt = new Event();
        
        $dsd = $request->start_date;

        if($note == 1){
            
            $dhi = '00:00:00';
            $dfi = $dsd.' '.$dhi;
            $dti = Carbon::createFromFormat('d/m/Y H:i:s', $dfi);
            $evt->start_date = $dti;
            
            $evt->all_day = $request->input('all_day_falso');
            $evt->event_name = $request->input('note_name');
            $evt->ciclo_modulo_id = 0;
            $evt->ciclo_id = $request->input('ciclo_oculto');
        }else{
            $dhi = $request->h_inicial;
            $dhf = $request->h_final;
            $dfi = $dsd.' '.$dhi;
            $dfe = $dsd.' '.$dhf;
            $dti = Carbon::createFromFormat('d/m/Y H:i', $dfi);
            $dtf = Carbon::createFromFormat('d/m/Y H:i', $dfe);
            $evt->start_date = $dti;
            $evt->end_date = $dtf;
            $evt->event_name = $request->input('event_name');
            $evt->ciclo_modulo_id = CargaHoraria::where('modulo_id', $request->input('event_name'))->where('profesor_id', Auth::user()->dni)->firstOrFail()->id;
            $evt->ciclo_id = CargaHoraria::select('grupo_id')->where('modulo_id', $evt->event_name)->where('profesor_id', Auth::user()->dni)->firstOrFail()->grupo_id;
        }
        
        $evt->user_id = Auth::user()->getId();
        $evt->color = $request->input('color');
        
        $evt->save();
        
        return redirect()->back();
    }

    public function update(Request $request){
        
        $note = $request->all_day;

        if($note == 1){
            
            $dhi = '00:00:00';
            $dfi = $dsd.' '.$dhi;
            $dti = Carbon::createFromFormat('d/m/Y H:i:s', $dfi);
            
            $param['start_date'] = $dti;
            $param['all_day'] = $request->all_day;
            $param['ciclo_modulo_id'] = 0;
            $param['ciclo_id'] = $request->ciclo;
            
        }else{
            $dsd = $request->start;
            $dhi = $request->hora_i;
            $dhf = $request->hora_f;;
            
            $dfi = $dsd.' '.$dhi;
            $dfe = $dsd.' '.$dhf;
            
            $dti = Carbon::createFromFormat('d/m/Y H:i', $dfi);
            $dtf = Carbon::createFromFormat('d/m/Y H:i', $dfe);
            
            $param['start_date'] = $dti;
            $param['end_date'] = $dtf;
            $param['ciclo_modulo_id'] = CargaHoraria::where('modulo_id', $request->name)->where('profesor_id', Auth::user()->dni)->firstOrFail()->id;
            $param['ciclo_id'] = CargaHoraria::select('grupo_id')->where('modulo_id', $request->name)->where('profesor_id', Auth::user()->dni)->firstOrFail()->grupo_id;
            
        }
        
        $param['event_name'] = $request->name;
        $param['color'] = $request->color;
        
        $event=Event::findOrFail($request->id);
        
        $r = $event->update($param);
        
        return response()->json($r);
    }
    
    public function show($grupo_id){
        dd("JEJE");
        $modulos = CargaHoraria::select('id', 'modulo_id')->where('grupo_id', $grupo_id)->where('profesor_id', Auth::user()->dni)->distinct()->get();
        $franjas = Franja::all();
        $events = Event::where('ciclo_id', $grupo_id)->where('user_id', Auth::user()->id)->get();
        
        return view('events',compact('modulos', 'franjas', 'events'));
    }
    
    public function destroy($id){
        
        $evt = Event::find($id)->delete();
        
        return redirect()->back();
    }
    
}
