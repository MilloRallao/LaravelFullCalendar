@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-1 invisible"></div>
        <div style="text-align:center;" class="jumbotron col-sm-4 shadow">
            <h1 class="display-4">Mis cursos</h1>
            <img src="img/calendar128.png"></img>
            <hr class="my-4" style="width:300px">
            <h5><span class="badge badge-pill badge-secondary">Elige un ciclo</span></h5>
            {!! Form::open(['url' => url('eventos'), 'method' => 'get']) !!}
                {!! Form::select('ciclo', $ciclos, null, ['title'=>'Selecciona un ciclo', 'class'=>'form-control selectpicker col-md-6', 'data-live-search'=>'true']) !!}
                    <hr class="my-4" style="width:300px">
                    <button class="btn btn-info btn-lg" type="submit">
                        <i class="fa fa-search"></i> Consultar
                    </button>
            {!! Form::close() !!}
        </div>
        <div class="col-sm-2 invisible"></div>
        <div style="text-align:center;" class="jumbotron col-sm-4 shadow">
            <h1 class="display-4">Otros cursos</h1>
            <img src="img/calendar128.png"></img>
            <hr class="my-4" style="width:300px">
            <h5><span class="badge badge-pill badge-secondary">Elige un ciclo</span></h5>
            {!! Form::open(['url' => url('otrosEventos'), 'method' => 'get']) !!}
                {!! Form::select('ciclo_no', $ciclos_no, null, ['title'=>'Selecciona un ciclo', 'class'=>'form-control selectpicker col-md-6', 'data-live-search'=>'true']) !!}
                    <hr class="my-4" style="width:300px">
                    <button class="btn btn-info btn-lg" type="submit">
                        <i class="fa fa-search"></i> Consultar
                    </button>
            {!! Form::close() !!}
        </div>
        <div class="col-sm-1 invisible"></div>
    </div>
</div>

@endsection
