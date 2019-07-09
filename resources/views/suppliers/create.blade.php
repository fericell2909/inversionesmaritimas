@extends('layouts.app')
@section('title', '| Crear Nuevo Proveedor')
@section('content')

    <div class="panel panel-default">
        <h2 class="text-info text-center">@lang('supplied.addprov')</h2>

        <div class="panel-body">
            {{ Form::open(['route' => 'suppliers.store', 'class' => 'form-horizontal']) }}
            <div class="form-group">
                {{Form::label('name' , trans('supplied.name'), ['class' => 'control-label col-sm-2'])}}
                <div class="col-sm-8">
                    {{Form::text('name', null, ['class'=>'form-control', 'placeholder' => trans('supplied.name')])}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('fax' , trans('supplied.ruc'), ['class' => 'control-label col-sm-2'])}}
                <div class="col-sm-8">
                    {{Form::text('ruc', null, ['class'=>'form-control', 'placeholder' => trans('supplied.ruc'),'maxlength'=>'11'])}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('address' , trans('supplied.address'), ['class' => 'control-label col-sm-2'])}}
                <div class="col-sm-8">
                    {{Form::text('address', null, ['class'=>'form-control', 'placeholder' => trans('supplied.address')])}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('telephone' , trans('supplied.phone'), ['class' => 'control-label col-sm-2'])}}
                <div class="col-sm-8">
                    {{Form::text('telephone', null, ['class'=>'form-control', 'placeholder' => trans('supplied.phone')])}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('fax' , trans('supplied.fax'), ['class' => 'control-label col-sm-2'])}}
                <div class="col-sm-8">
                    {{Form::text('fax', null, ['class'=>'form-control', 'placeholder' => trans('supplied.fax')])}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('info' , trans('supplied.info'), ['class' => 'control-label col-sm-2'])}}
                <div class="col-sm-8">
                    {{Form::textarea('info', null, ['class'=>'form-control', 'id' => 'textarea', 'placeholder' => trans('supplied.info')])}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('estado' ,trans('supplied.estado'), ['class' => 'control-label col-sm-2'])}}
                <div class="col-sm-8">
                    
                    <select class="form-control text-center" name="estado" id="estado">
                                     <option selected value="1">Activo</option>
                                     <option  value="2">Inactivo</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn  btn-info"><i class="fa fa-plus-circle"
                                                                   aria-hidden="true"></i> @lang('button.create')
                    </button>
                </div>
            </div>
        {{ Form::close() }} <!-- end form -->
        </div> <!-- end div .panel-body -->
    </div> <!-- end div .panel -->

@endsection
