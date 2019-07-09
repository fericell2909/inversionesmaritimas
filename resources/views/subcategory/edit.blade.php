@extends('layouts.app')
@section('title', '| Editar Sub Categoria')

@section('content')
    <div class="panel panel-default">
        <h2 class="text-center text-info">@lang('subcategory.edittitle') {{$subcategory->name}}</h2>
        <div class="panel-body">
            {{Form::model ($subcategory, ['route' => ['subcategory.update', $subcategory->id], 'method' => 'PUT', 'class' => 'form-horizontal' ])}}
            <div class="form-group">
                {{Form::label('name' , 'Categoria', ['class' => 'control-label col-sm-2'])}}
                <div class="col-sm-10">
                    <select name="categories_id" id="categories_id" class="form form-control" readonly >
                        @foreach($category as $cat)
                            @if($subcategory->categories_id == $cat->id)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                {{Form::label('name' ,trans('subcategory.name'),['class' => 'control-label col-sm-2'])}}
                <div class="col-sm-10">
                    {{Form::text('name', $subcategory->name, ['class'=>'form-control', 'placeholder' => 'Nombre'])}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('name' , 'Estado', ['class' => 'control-label col-sm-2'])}}
                <div class="col-sm-10">
                    <select name="estado_id" id="estado_id" class="form form-control">
                        @if($subcategory->estado_id == 1)
                            <option selected value="1">Activo</option>
                            <option value="2">Inactivo</option>
                        @else
                            <option  value="1">Activo</option>
                            <option selected value="2">Inactivo</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-info"><i class="fa fa-pencil"
                                                                  aria-hidden="true"></i> @lang('button.update')
                    </button>
                </div>
            </div>
        {{Form::close()}}    <!-- end form -->

        </div> <!-- end div .panel-body -->
    </div>  <!-- end div .panel -->

@endsection
