@extends('layouts.app')
@section('title', '| Agregar Serie')
@section('content')
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="panel panel-default">
                <h3 class="text-center text-info">@lang('series.add')</h3>
            <div class="panel-body">
                
                {{Form::open(['route' => ['series.guardarserie'],'method' => 'POST', 'class' => 'form-horizontal' ])}}

                <div class="col-md-12">
                    <div class="form-group">
                        {{Form::label('name' ,trans('series.tipodocumento'), ['class' => 'control-label col-sm-2'])}}
                        
                        <div class="col-sm-8">

                            <select name="tipo_documento_id" id="tipo_documento_id" class="form-control" required="required">
                            
                                @foreach($tiposdocumentos as $tiposdocumento)
                                        <option value="{{$tiposdocumento->tipo_documento_id}}">{{$tiposdocumento->descripcion_tipo_documento}}</option>
                                    
                                @endforeach
                            </select>

                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('numero' , trans('series.numero'), ['class' => 'control-label col-sm-2'])}}
                        <div class="col-sm-8">
                            {{Form::text('numero',  null, ['class'=>'form-control numero', 'maxlength' => '3','placeholder' => trans('series.numero')])}}
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <div class="col-md-2 col-xs-offset-1">
                            <button class="btn btn-info" id="btnSetting" name="button" type="submit">
                                <i class="fa fa-pencil" aria-hidden="true"></i> Agregar Serie
                            </button>
                        </div> <!-- end col 2 -->
                    </div>
                </div> <!-- end col 12 -->
            </div> <!-- end div .panel-body -->
        {{Form::close()}} <!-- end form -->
        </div> <!-- end div .panel -->
    </div> <!-- end col 12 -->

<script>
        
        $(function () {
            
             $(".numero").on("keydown", function (e) {
                    //console.log(e.keyCode);

                    if ( e.keyCode == 8 ||  e.keyCode == 37 ||  e.keyCode == 39 )
                    {
                        return true;
                    }

                    if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 || (e.keyCode == 65 && e.ctrlKey === true) || (e.keyCode >= 35 && e.keyCode <= 39)) 
                    {
                        return false;
                    }
             
                    if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105 )) {
                        e.preventDefault();
                    }
                })
        });

</script>
@endsection