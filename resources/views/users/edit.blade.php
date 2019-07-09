@extends('layouts.app')
@section('title', '| Editar Cuenta de Usuario')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-heading"><h2 class="text-info text-center">@lang('users.edit')</h2></div>

        </div>
        <div class="panel-body">
            {{ Form::model($users, ['route' => ['users.update', $users->id],  'method' => 'PUT', 'class' => 'form-horizontal'  ])}}
            <div class="form-group">
                {{Form::label('name' ,trans('users.name'), ['class' => 'control-label col-sm-2'])}}
                <div class="col-sm-8">
                    {{Form::text('name',  $users->name, ['class'=>'form-control', 'placeholder' => trans('users.name')])}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('email' , trans('users.email'), ['class' => 'control-label col-sm-2'])}}
                <div class="col-sm-8">
                    {{Form::text('email',  $users->email, ['class'=>'form-control', 'placeholder' => trans('users.email')])}}
                </div>
            </div>
            <div class="form-group">
                {{Form::label('password' , trans('users.password'), ['class' => 'control-label col-sm-2'])}}
                <div class="col-sm-8">
                    {{Form::text('password',null, ['class'=>'form-control', 'placeholder' => trans('users.password') ])}}
                </div>
            </div>
            {{-- <div class="form-group">
                {{Form::label('permission' , trans('users.permission'), ['class' => 'control-label col-sm-2'])}}
                <div class="col-sm-10">
                    <div class="togglebutton">
                        <label>
                            <input id="togglePermission" name="permission" type="checkbox"
                                   @if($users->roles_id === 1)
                                   checked=""
                                   value="1"
                                   @elseif ($users->roles_id === 2)
                                   value="2"
                                   @else
                                   value="2"
                                    @endif />
                            @lang('users.superadmin')

                        </label>
                    </div>
                </div>
            </div> --}}

            <div class="form-group">
                {{Form::label('permission' ,trans('users.permission'), ['class' => 'control-label col-sm-2'])}}
                <div class="col-sm-8">
                    
                    <select class="form-control text-center" name="role" id="role">
                            @foreach($roles as $role)
                                @if($role->id == $users->roles_id)
                                     <option selected value="{{ $role->id }}">{{ $role->name}}</option>
                                @else
                                    <option  value="{{ $role->id }}">{{ $role->name}}</option>
                                @endif
                            @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                {{Form::label('estado' ,trans('users.estado'), ['class' => 'control-label col-sm-2'])}}
                <div class="col-sm-8">
                    
                    <select class="form-control text-center" name="estado" id="estado">
                                @if($users->estado_id == 1)
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
                    <button class="btn btn-info" type="submit">
                        <i class="fa fa-pencil" aria-hidden="true"></i> @lang('button.update')
                    </button>
                </div>
            </div>
        {{ Form::close() }}
        <!-- end form -->
        </div>
        <!-- end div .panel-body -->
    </div>
    <!-- end div .panel -->
@endsection
