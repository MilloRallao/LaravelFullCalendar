@extends('layouts.app')

@section('content')

<div class="container">
    <a style="text-decoration:none" class="boton centrar" href='{{ url()->previous() }}'></a>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- DETAILS MODAL -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabe2" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Detalles Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="form-group" value="">
                            <label for="event_name">Módulo:</label>
                            <input type="text" class="form-control" id="select_u" name="event_name" readonly>
                        </div>
                        <div class="form-group" value="">
                            <label for="prof">Profesor:</label>
                            @foreach($modulos as $modulo)
                                @if($_GET['ciclo_no'] == $modulo->grupo_id)
                                    @foreach($eventos as $evento)
                                        @if($evento->event_name == $modulo->modulo_id)
                                            @if($evento->ciclo_modulo_id == $modulo->id)
                                                <input type="text" name="prof" id="prof" class="form-control" readonly value="{{ $modulo->profesor_id }}">
                                            @endif
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
                        <div class="form-group" value="">
                            <label for="start_date">Fecha:</label>
                            <div class="input-group date">
                                <input type="text" name="start_date" id="datetimepicker2" class="form-control" readonly/>
                                <div class="input-group-append">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="invisible" value="">
                            <input type="hidden" id="end_date_u"/>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6" value="">
                                <label for="h_inicial">Hora inicio:</label>
                                <input name="h_inicial" class="form-control" id="h_inicial_u" readonly/>
                            </div>
                            <div class="form-group col-md-6" value="">
                                <label for="h_final">Hora fin:</label>
                                <input name="h_final" class="form-control" id="h_final_u" readonly/>
                            </div>
                        </div>
                        <div class="form-group" value="">
                            <label for="color">Color:</label>
                            <input type="text" class="form-control" id="color_u" readonly/>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    
</div>
  
  <script type="text/javascript">
  
   var ciclo = '{!!$request->ciclo_no!!}';
  
    $(function() {
        
        var popTemplate = ['<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'].join('');
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $('[data-toggle="popover"]').popover();
        
        var evt = [];
        $.ajax({
           url: 'otrosEvents?ciclo='+ciclo,
           type: "GET",
           dataType: "JSON",
           async: false,
        }).done(function(r){
            evt = r;
        });
        
        $('#calendar').fullCalendar({
            selectable: false, //Permite seleccionar días/horas
            editable: false, //Permite arrastrar y alargar eventos
            nowIndicator: true, //indicador de momento actual
            eventLimit: true, //Mostar "más" cuando en una celda hay demasiados elementos
            weekends: false, //No mostrar fines de semana
            displayEventEnd: true, //Mostrar el final del evento
            slotLabelFormat: 'H:mm', //Formato de hora de los slots en la vista agendaWeek
            themeSystem: 'bootstrap4', //Sistema de Theme escogido
            themeName: 'sketchy', //Theme escogido
            eventConstraint: "businessHours", //No permitir poner eventos en horarios establecidos
            events: evt, //Eventos
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
            eventRender: function(event, element){
              element.popover({
                    placement: 'auto',
                    html: true,
                    animation:true,
                    delay: 300,
                    template: popTemplate,
                    title: event.title,
                    content: $('#prof').val(),
                    trigger: 'hover',
              });
            },
            eventClick: function(event) {
                $('#exampleModal2').on('show.bs.modal', function(){
                    $('#select_u').val(event.title);
                    $('#datetimepicker2').val(event.start.format('DD/MM/YYYY'));
                    $('#end_date_u').val(event.end.format('DD/MM/YYYY'));
                    $('#h_inicial_u').val(event.start.format('H:mm'));
                    $('#h_final_u').val(event.end.format('H:mm'));
                    $('#color_u').val(event.color);
                });
                
                $('#exampleModal2').modal('show');
            }
        });
        
    });
  </script>
  
</div>

@endsection