@extends('layouts.app')
@section('title', '| Nueva Sub Categoria')

@section('content')
    <div class="panel panel-default">

        <h2 class="text-center text-info">@lang('subcategory.addtitle')</h2>
        <div class="panel-body">
            {{Form::open (['route' => 'subcategory.store',  'class' => 'form-horizontal' ])}}
            <div class="form-group">
                {{Form::label('name' , 'Categoria', ['class' => 'control-label col-sm-2'])}}
                <div class="col-sm-10">
                    <select name="categories_id" id="categories_id" class="form form-control">
                        @foreach($category as $cat)
                            <option value="{{$cat->id}}">{{$cat->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                {{Form::label('name' , trans('subcategory.name'), ['class' => 'control-label col-sm-2'])}}
                <div class="col-sm-10">
                    {{Form::text('name', null, ['class'=>'form-control', 'placeholder' => trans('subcategory.name')])}}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-info">@lang('button.create')</button>
                </div>
            </div>
        {{Form::close()}}    <!-- end form -->
        </div>
    </div>

@endsection
