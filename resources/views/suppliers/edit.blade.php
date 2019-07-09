@extends('layouts.app')
@section('title', '| Editar Proveedor')
@section('content')

    <div class="panel panel-default">
        <div class="panel-heading"><h2 class="text-info text-center">@lang('supplied.editprov') {{$suppliers->name}}</h2></div>
        <div class="panel-body">
            {{ Form::model($suppliers, ['route' => ['suppliers.update', $suppliers->id],  'method' => 'PUT', 'class' => 'form-horizontal'  ])}}
            <div class="form-group">
                {{Form::label('name' ,trans('supplied.name'), ['class' => 'control-label col-sm-2'])}}
                <div class="col-sm-10">
                    {{Form::text('name',  $suppliers->name, ['class'=>'form-control', 'placeholder' => trans('supplied.name')])}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('fax' , trans('supplied.ruc'), ['class' => 'control-label col-sm-2'])}}
                <div class="col-sm-8">
                    {{Form::text('ruc', $suppliers->ruc, ['class'=>'form-control', 'placeholder' => trans('supplied.ruc'),'maxlength'=>'11'])}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('address' , trans('supplied.address'), ['class' => 'control-label col-sm-2'])}}
                <div class="col-sm-10">
                    {{Form::text('address',  $suppliers->address, ['class'=>'form-control', 'placeholder' => trans('supplied.address')])}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('telephone' , trans('supplied.phone'), ['class' => 'control-label col-sm-2'])}}
                <div class="col-sm-10">
                    {{Form::text('telephone',  $suppliers->phone, ['class'=>'form-control', 'placeholder' => trans('supplied.phone')])}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('fax' , trans('supplied.fax'), ['class' => 'control-label col-sm-2'])}}
                <div class="col-sm-10">
                    {{Form::text('fax', $suppliers->fax, ['class'=>'form-control', 'placeholder' => trans('supplied.fax') ])}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('info' , trans('supplied.info'), ['class' => 'control-label col-sm-2'])}}
                <div class="col-sm-10">
                    {{Form::textarea('info',  $suppliers->info, ['class'=>'form-control','id' => 'textarea', 'placeholder' => trans('supplied.info')])}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('estado' ,trans('supplied.estado'), ['class' => 'control-label col-sm-2'])}}
                <div class="col-sm-8">
                    
                    <select class="form-control text-center" name="estado" id="estado">
                                @if($suppliers->estado_id == 1)
                                     <option selected value="1">Activo</option>
                                     <option  value="2">Inactivo</option>
                                @else
                                    <option value="1">Activo</option>
                                    <option selected value="2">Inactivo</option>
                                @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn  btn-info"><i class="fa fa-pencil"
                                                                   aria-hidden="true"></i> @lang('button.update')
                    </button>
                </div>
            </div>
        {{ Form::close() }} <!-- end form -->
        </div> <!-- end div .panel-body -->
    </div> <!-- end div .panel -->

@endsection
