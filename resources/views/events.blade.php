@extends('layouts.app')

@section('content')

<div class="container">
    
    <a style="text-decoration:none" class="boton centrar" href='{{ url()->previous() }}'></a>
    
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script type="text/javascript">
            toastr.warning('{{ $error }}', 'Error');
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "3000",
                    "hideDuration": "3000",
                    "timeOut": "8000",
                    "extendedTimeOut": "3000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
            </script>
        @endforeach
    @endif
    
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- CREATE MODAL -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                {!! Form::open(['route' => 'eventos.store']) !!}
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-sm-3 invisible"></div>
                        <div class="col-sm-6">
                            {!! Form::label('all_day', '¿Convertir en Anotación?') !!}
                        </div>
                        <div class="form-group col-sm-3 invisible"></div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-4 invisible"></div>
                        <div class="form-group col-sm-4">
                            {!! Form::checkbox("all_day", null, ['id'=>'all_day']) !!}
                        </div>
                        <div class="form-group col-sm-4 invisible"></div>
                    </div>
                    <div class="invisible" value="{{ old('all_day_falso') }}">
                        {!! Form::hidden('all_day_falso', null, ['id'=>'all_day_falso']) !!}
                    </div>
                    
                    {!! Form::hidden('ciclo_oculto', $request->ciclo, ['id'=>'ciclo_oculto']) !!}
                    
                    <div id="select_div" class="form-group" value="{{ old('event_name') }}">
                        {!! Form::label('event_name', 'Módulo:') !!}
                        {!! Form::select('event_name', $modulos->pluck('modulo_id','modulo_id'), null, array('class'=>'selectpicker form-control', 'title'=>'Selecciona un módulo', 'id'=>'select_')) !!}
                    </div>
                    
                    <div id="text_div" class="form-group invisible" value="{{ old('note_name') }}">
                        {!! Form::label('note_name', 'Título:') !!}
                        {!! Form::text('note_name',null,['class'=>'form-control', 'id'=>'note_name']) !!}
                    </div>
                    <div class="form-group" value="{{ old('start_date') }}">
                        {!! Form::label('start_date', 'Fecha:') !!}
                        <div class="input-group date">
                            {!! Form::text("start_date", null, ['class' => 'form-control', 'id'=>'start_date']) !!}
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="invisible" value="{{ old('end_date') }}">
                        {!! Form::hidden('end_date', null, ['id'=>'end_date']) !!}
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6" value="{{ old('h_inicial') }}">
                            {!! Form::label('h_inicial', 'Hora inicio:') !!}
                            {!! Form::select('h_inicial', $franjas->pluck('h_inicial','h_inicial'), null, array('class'=>'selectpicker form-control', 'title'=>'Selecciona hora de inicio', 'id'=>'h_inicial')) !!}
                        </div>
                        <div class="form-group col-sm-6" value="{{ old('h_final') }}">
                            {!! Form::label('h_final', 'Hora fin:') !!}
                            {!! Form::select('h_final', $franjas->pluck('h_final','h_final'), null, array('class'=>'selectpicker form-control', 'title'=>'Selecciona hora de fin', 'id'=>'h_final')) !!}
                        </div>
                    </div>
                    <div class="form-group" value="{{ old('color') }}">
                        {!! Form::label('color', 'Color del evento:') !!}
                        {!! Form::select('color', array('red' => 'Rojo', 'green' => 'Verde', 'blue' => 'Azul', 'black' => 'Negro', 'pink' => 'Rosa', 'yellow' => 'Amarillo', 'purple' => 'Violeta', 'orange' => 'Naranja', 'brown' => 'Marron', 'grey' => 'Gris', 'white' => 'Blanco'), null, ['class'=>'selectpicker form-control', 'title'=>'Selecciona color del evento']) !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    {!! Form::submit('Guardar', ['class' => 'btn btn-primary form-control']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    
    <!-- UPDATE MODAL -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabe2" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    
                    <div class="form-group" value="{{ old('event_name') }}">
                        {!! Form::label('event_name', 'Módulo:') !!}
                        {!! Form::select('event_name', $modulos->pluck('modulo_id','modulo_id'), null, array('class'=>'selectpicker form-control', 'title'=>'Selecciona un módulo', 'id'=>'select_u')) !!}
                    </div>
                    
                    
                    <div class="form-group" value="{{ old('start_date') }}">
                        <label for="start_date">Fecha:</label>
                        <div class="input-group date">
                            <input type="text" name="start_date" id="datetimepicker2" class="form-control datetimepicker-input" data-target="#datetimepicker2" data-toggle="datetimepicker" autocomplete="off"/>
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="invisible" value="{{ old('end_date_u') }}">
                        <input type="hidden" id="end_date_u"/>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6" value="{{ old('h_inicial') }}">
                        <label for="h_inicial">Hora inicio:</label>
                        <select name="h_inicial" class="selectpicker form-control" title="Selecciona hora de inicio" id="h_inicial_u">
                            @foreach($franjas as $franja)
                                <option value="{{$franja->id}}">{{ $franja->h_inicial}}</option>
                            @endforeach
                        </select>
                        </div>
                        <div class="form-group col-sm-6" value="{{ old('h_final') }}">
                        <label for="h_final">Hora fin:</label>
                        <select name="h_final" class="selectpicker form-control" title="Selecciona hora de fin" id="h_final_u">
                            @foreach($franjas as $franja)
                                <option value="{{$franja->id}}">{{ $franja->h_final}}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group" value="{{ old('color') }}">
                        <label for="color_u">Color:</label>
                        <select name="color_u" class="selectpicker form-control" title="Selecciona color del evento" id="color_u">
                                <option value="red">Rojo</option>
                                <option value="green">Verde</option>
                                <option value="blue">Azul</option>
                                <option value="black">Negro</option>
                                <option value="pink">Rosa</option>
                                <option value="yellow">Amarillo</option>
                                <option value="purple">Violeta</option>
                                <option value="orange">Naranja</option>
                                <option value="brown">Marrón</option>
                                <option value="grey">Gris</option>
                                <option value="white">Blanco</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#myModal1">Borrar</button>
                    <button type="button" class="btn btn-primary form-control" id="actualizar">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- UPDATE NOTE MODAL -->
    <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabe3" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Anotación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    
                    <div class="form-group" value="{{ old('note_name') }}">
                        {!! Form::label('note_name', 'Título:') !!}
                        {!! Form::text('note_name',null,['class'=>'form-control', 'id'=>'note_name_u']) !!}
                    </div>
                    <div class="form-group" value="{{ old('start_date') }}">
                        <label for="start_date">Fecha:</label>
                        <div class="input-group date">
                            <input type="text" name="start_date" id="datetimepicker3" class="form-control datetimepicker-input" data-target="#datetimepicker3" data-toggle="datetimepicker" autocomplete="off"/>
                            <div class="input-group-append">
                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" value="{{ old('color') }}">
                        <label for="color_u_note">Color:</label>
                        <select name="color_u_note" class="selectpicker form-control" title="Selecciona color del evento" id="color_u_note">
                                <option value="red">Rojo</option>
                                <option value="green">Verde</option>
                                <option value="blue">Azul</option>
                                <option value="black">Negro</option>
                                <option value="pink">Rosa</option>
                                <option value="yellow">Amarillo</option>
                                <option value="purple">Violeta</option>
                                <option value="orange">Naranja</option>
                                <option value="brown">Marrón</option>
                                <option value="grey">Gris</option>
                                <option value="white">Blanco</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#myModal1">Borrar</button>
                    <button type="button" class="btn btn-primary form-control" id="actualizar_note">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- DELETE SUB-MODAL -->
    <div class="modal fade" id="myModal1">
        <div class="modal-dialog" >
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title">Borrar Evento</h5>
                <button type="button" class="close" data-dismiss="modal">
                  <span>&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p>¿Seguro que quieres borrar este evento?</p>
              </div>
              <div class="modal-footer">
                  <form method="post" action="" id="delete_form">
                    @csrf
                    <button class="btn btn-danger" type="submit">
                        Sí
                    </button>
                 </form>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
              </div>
            </div>
        </div>
    </div>
    
</div>
  
  <script type="text/javascript">
  
   var ciclo = '{!!$request->ciclo!!}';
  
    $(function() {
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $('[data-toggle="popover"]').popover();
        
        $("#all_day").bootstrapSwitch({
            state: false,
            onText: 'SI', // Texto de la opción izquierda del switch
            offText: 'NO', // Texto de la opción derecha del switch
        });
        
        var evt = [];
        $.ajax({
           url: '/events?ciclo='+ciclo,
           type: "GET",
           dataType: "JSON",
           async: false,
        }).done(function(r){
            evt = r;
        });
        
        var popover;
        
        var anotacion;
        
        // Triggered on switch state change.
        $('#all_day').on('switchChange.bootstrapSwitch', function(event, state) {
            if(state){
                anotacion = 1;
                $('#select_div').addClass('invisible');
                $('#h_inicial').attr('disabled', true);
                $('#h_final').attr('disabled', true);
                $('#text_div').removeClass('invisible');
                $('.selectpicker').selectpicker('refresh');
                $('#all_day_falso').val(anotacion);
            }else{
                anotacion = 0;
                $('#select_div').removeClass('invisible');
                $('#h_inicial').removeAttr('disabled');
                $('#h_final').removeAttr('disabled');
                $('#text_div').addClass('invisible');
                $('.selectpicker').selectpicker('refresh');
            }
        });
        
        $('#calendar').fullCalendar({
            selectable: true, //Permite seleccionar días/horas
            editable: true, //Permite arrastrar y alargar eventos
            nowIndicator: true, //indicador de momento actual
            eventLimit: true, //Mostar "más" cuando en una celda hay demasiados elementos
            weekends: false, //No mostrar fines de semana
            displayEventEnd: true, //Mostrar el final del evento
            slotLabelFormat: 'H:mm', //Formato de hora de los slots en la vista agendaWeek
            themeSystem: 'bootstrap4', //Sistema de Theme escogido
            themeName: 'sketchy', //Theme escogido
            events: evt, //Eventos
            eventConstraint: "businessHours", //No permitir poner eventos en horarios establecidos
            defaultTimedEventDuration: '00:55:00', //duración por defecto de un evento
            header: {
              left:   'listWeek today',
              center: 'prevYear prev title next nextYear',
              right:  'month agendaWeek agendaDays'
            },
            views: {
                month: {
                    timeFormat: 'h:mm',
                },
                agendaWeek: {
                    slotDuration: '01:00:00',
        			minTime: '08:00',
        			maxTime: '23:00',
                }
            },
            businessHours: [
                {
                    dow: [ 1, 2, 3, 4, 5 ],
                    start: '08:00',
                    end: '10:45'
                },
                {
                    dow: [ 1, 2, 3, 4, 5 ],
                    start: '11:15',
                    end: '14:00'
                },
                {
                    dow: [ 1, 2, 3, 4, 5 ],
                    start: '15:00',
                    end: '17:45'
                },
                {
                    dow: [ 1, 2, 3, 4, 5 ],
                    start: '18:15',
                    end: '22:50'
                }
            ],
            eventDrop: function(event, delta) {
                var id_e = event.id;
                var start_e = event.start.format();
                var end_e = event.end.format();
                $.post("calendar/updEvento?id="+id_e+"&start="+start_e+"&ended="+end_e).done(function(){
                    console.log('funciono  :) ');
                }).fail(function(){
                    console.log('no funciono  :( ');
                });
            },
            dayClick: function(date, view) {
                $('#exampleModal1').modal('show');
                
                $('#start_date').prop('readonly',false);
                
                if(anotacion = 0){
                    $('#start_date').val(date.format('DD/MM/YYYY H:mm'));
                    $('#end_date').val(date.format('DD/MM/YYYY H:mm'));
                }else if(anotacion = 1){
                    $('#start_date').val(date.format('DD/MM/YYYY'));
                    $('#end_date').val(date.format('DD/MM/YYYY'));
                }

                $('#start_date').prop('readonly',true);
            },
            eventClick: function(event) {
                var selected;
                var hi;
                var hf;
                if(event.allDay){
                    $('#exampleModal3').on('show.bs.modal', function(){
                        $('#datetimepicker3').val(event.start.format('DD/MM/YYYY'));
                        $('#note_name_u').val(event.title);
                        $('#color_u').val(event.color);
                    });
                    $("#color_u_note").change(function(){
                        selected = $(this).children("option:selected").text();
                    });
                    $('#myModal1').on('show.bs.modal', function() {
                        $('#delete_form').prop('action', 'eventos/delete/' + event.id)
                    });
                    $('#actualizar_note').on('click', function(){
                        
                        var id_e = event.id;
                        var name_e = $('#note_name_u').val();
                        var start_e = $('#datetimepicker3').val();
                        var color_e = $('#color_u').val();
                        var ciclo_e = $('#ciclo_oculto').val();
                        
                        $.ajax({
                            url: 'calendar/update?id='+id_e+'&name='+name_e+'&start='+start_e+'&color='+color_e+'&all_day='+event.allDay+'&ciclo='+ciclo_e,
                            type: 'POST',
                        }).done(function(){
                            toastr.info('¡Actualizado con éxito!', 'Correcto');
                            $('#exampleModal3').modal('hide');
                            $('#calendar').fullCalendar('removeEvents');
                            $('#calendar').fullCalendar('addEventSource', '/events?ciclo='+ciclo);
                            $('#calendar').fullCalendar('refetchEvents');
                        }).fail(function(jqXHR, textStatus, data) {
                            toastr.warning(jqXHR.responseJSON.message);
                        });
                    });
                    
                    $('#exampleModal3').modal('show');
                }else{
                    $('#exampleModal2').on('show.bs.modal', function(){
                        $('#datetimepicker2').val(event.start.format('DD/MM/YYYY'));
                        $('#end_date_u').val(event.end.format('DD/MM/YYYY'));
                        
                        $('#color_u').val(event.color);
                    });
                    $("#select_u").change(function(){
                        selected = $(this).children("option:selected").text();
                    });
                    $("#h_inicial_u").change(function(){
                        hi = $(this).children("option:selected").text();
                    });
                    $("#h_final_u").change(function(){
                        hf = $(this).children("option:selected").text();
                    });
                    $('#myModal1').on('show.bs.modal', function() {
                        $('#delete_form').prop('action', 'eventos/delete/' + event.id)
                    });
                    $('#actualizar').on('click', function(){
                        
                        var id_e = event.id;
                        var name_e = selected;
                        var start_e = $('#datetimepicker2').val();
                        var h_i_e = hi;
                        var h_f_e = hf;
                        var end_e = $('#end_date_u').val();
                        var color_e = $('#color_u').val();
                        
                        $.ajax({
                            url: 'calendar/update?id='+id_e+'&name='+name_e+'&start='+start_e+"&hora_i="+h_i_e+"&hora_f="+h_f_e+'&ended='+end_e+'&color='+color_e+'&all_day='+event.allDay,
                            type: 'POST',
                        }).done(function(){
                            toastr.info('¡Actualizado con éxito!', 'Correcto');
                            $('#exampleModal2').modal('hide');
                            $('#calendar').fullCalendar('removeEvents');
                            $('#calendar').fullCalendar('addEventSource', '/events?ciclo='+ciclo);
                            $('#calendar').fullCalendar('refetchEvents');
                        }).fail(function(jqXHR, textStatus, data) {
                            toastr.warning(jqXHR.responseJSON.message);
                        });
                    });
                    
                    $('#exampleModal2').modal('show');
                }
            },
        });
        
        $('#datetimepicker2').datetimepicker({
            viewMode: 'days',
            format: 'DD/MM/YYYY',
            daysOfWeekDisabled: [0,6],
            locale: moment.locale('es'),
            useCurrent: false,
            icons: {
                today: 'far fa-calendar-check fa-lg',
                close: 'fas fa-check'
            },
            buttons: {
                showToday: true,
                showClose: true
            },
            tooltips: {
                today: 'Ir a Hoy',
                clear: 'Limpiar selección',
                close: 'Aceptar',
                selectMonth: 'Seleccionar Mes',
                prevMonth: 'Anterior Mes',
                nextMonth: 'Siguiente Mes',
                selectYear: 'Seleccionar Año',
                prevYear: 'Anterior Año',
                nextYear: 'Siguiente Año',
                selectDecade: 'Seleccionar Década',
                prevDecade: 'Anterior Década',
                nextDecade: 'Siguiente Década',
                prevCentury: 'Anterior Siglo',
                nextCentury: 'Siguiente Siglo'
            }
        });
        
        $('#datetimepicker3').datetimepicker({
            viewMode: 'days',
            format: 'DD/MM/YYYY',
            daysOfWeekDisabled: [0,6],
            locale: moment.locale('es'),
            useCurrent: false,
            icons: {
                today: 'far fa-calendar-check fa-lg',
                close: 'fas fa-check'
            },
            buttons: {
                showToday: true,
                showClose: true
            },
            tooltips: {
                today: 'Ir a Hoy',
                clear: 'Limpiar selección',
                close: 'Aceptar',
                selectMonth: 'Seleccionar Mes',
                prevMonth: 'Anterior Mes',
                nextMonth: 'Siguiente Mes',
                selectYear: 'Seleccionar Año',
                prevYear: 'Anterior Año',
                nextYear: 'Siguiente Año',
                selectDecade: 'Seleccionar Década',
                prevDecade: 'Anterior Década',
                nextDecade: 'Siguiente Década',
                prevCentury: 'Anterior Siglo',
                nextCentury: 'Siguiente Siglo'
            }
        });
        
    });
  </script>
  
</div>

@endsection