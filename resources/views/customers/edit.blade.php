@extends('layouts.app')
@section('title', '| Editar Paciente ')
@section('content')

    <div class="panel panel-default">
        <h2 class="text-center text-info">@lang('customers.editcust') {{$customers->name}}</h2>

        <div class="panel-body">
            {{ Form::model($customers, ['route' => ['customers.update', $customers->id],  'method' => 'PUT', 'class' => 'form-horizontal'  ])}}

            <div class="form-group">
                
                @if($customers->tipo == 1)
                    {{Form::label('name' ,'Nombres y Apellidos', ['class' => 'control-label col-sm-2'])}}
                @else
                    {{Form::label('name' ,'Razon Social', ['class' => 'control-label col-sm-2'])}}
                @endif
                

                <div class="col-sm-8">
                    
                    @if($customers->tipo == 1)
                        {{Form::text('name',  $customers->name, ['class'=>'form-control', 'placeholder' => 'Nombres y Apellidos'])}}
                    @else
                        {{Form::text('name',  $customers->name, ['class'=>'form-control', 'placeholder' => 'Razon Social'])}}
                    @endif    
                </div>

            </div>
            <div class="form-group">
                
                @if($customers->tipo == 1)
                    {{Form::label('dni' , 'dni', ['class' => 'control-label col-sm-2'])}}
                @else
                    {{Form::label('dni' , 'ruc', ['class' => 'control-label col-sm-2'])}}
                @endif

                
                
                <div class="col-sm-8">
                    @if($customers->tipo == 1)
                        {{Form::text('dni',  $customers->dni, ['class'=>'form-control','readonly'=>'readonly' ,'maxlength'=>8 ,'placeholder' => 'dni'])}}
                    @else
                        {{Form::text('dni',  $customers->dni, ['class'=>'form-control','readonly'=>'readonly' , 'maxlength'=>11 ,'placeholder' => 'ruc'])}}
                    @endif

                </div>
            </div>
            <div class="form-group">
                {{Form::label('phone' , trans('customers.phone'), ['class' => 'control-label col-sm-2'])}}
                <div class="col-sm-8">
                    {{Form::text('phone',  $customers->phone, ['class'=>'form-control', 'placeholder' => trans('customers.phone')])}}
                </div>
            </div>

            <div class="form-group">
                {{Form::label('info' , trans('customers.info'), ['class' => 'control-label col-sm-2'])}}
                <div class="col-sm-8">
                    {{Form::textarea('info',  $customers->info, ['class'=>'form-control','id' => 'textarea',  'placeholder' => trans('customers.info')])}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('estado' ,trans('users.estado'), ['class' => 'control-label col-sm-2'])}}
                <div class="col-sm-8">
                    
                    <select class="form-control text-center" name="estado" id="estado">
                                @if($customers->estado_id == 1)
                                     <option selected value="1">Activo</option>
                                     <option  value="2">Inactivo</option>
                                @else
                                    <option value="1">Activo</option>
                                    <option selected value="2">Inactivo</option>
                                @endif
                    </select>
                </div>
            </div>
            <input type="text" name="tipo" id="tipo" style="display:none;" class="form-control" value="{{$customers->tipo}}" required="required"  title="">
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-8">
                    <button type="submit" class="btn  btn-info"><i class="fa fa-pencil"
                                                                   aria-hidden="true"></i> @lang('button.update')
                    </button>
                </div>
            </div>
        {{ Form::close() }} <!--end form !-->
        </div> <!-- end div .panel-body -->
    </div> <!-- end div .panel -->

@endsection
