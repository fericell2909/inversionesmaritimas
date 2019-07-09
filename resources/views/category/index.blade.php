@extends('layouts.app')
@section('title', '| Categorias')
@section('content')

    <div class="panel panel-default">
        <h2 class="text-center text-info">@lang('category.title')</h2>
        <div class="panel-body">
            <div id="tablePanel">
                <a href="{{url('/category/create')}}">
                    <button class="btn btn-sm btn-info" data-id=""><i class="fa fa-plus-circle"
                                                                      aria-hidden="true"></i> @lang('category.addcat')
                    </button>
                </a>
            </div> <!-- end div #tablePanel -->

            <div class="col-md-12">
                <div class="table-responsive" id="divProductTable">
                    <table class="table table-hover results">
                        <tr>
                            <th>#</th>
                            <th>@lang('category.name')</th>
                            <th>Estado</th>
                            <th class="text-center" >@lang('category.control')</th>
                        </tr>
                        <tbody class="table-responsive" id="categoryDivBox">
                        @foreach($category as $cat)
                            <tr>
                                <td>{{  $cat->id   }}</td>
                                <td>{{  $cat->name }}</td>
                                {{-- <td>{{  date('d-M-Y-g:i ', strtotime($cat->created_at)) }}</td> --}}
                                <td>
                                @if($cat->estado_id == 1)
                                    <span class="label label-success">
                                           Activo
                                        </span>
                                @else
                                    <span class="label label-danger">
                                           Inactivo
                                        </span>
                                @endif
                                </td>
                                <td>
                                    <a href="{{route('category.edit', $cat->id)}}">
                                        <button class="btn btn-xs btn-white"><i class="fa fa-pencil"
                                                                                aria-hidden="true"></i> @lang('button.edit')
                                        </button>
                                    </a>
                                    {{Form::open(['route' => ['category.destroy', $cat->id], 'method' => 'DELETE' , 'id' => 'deleteFormCategory'])}}

                                    {{Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> '.trans('button.delete'), ['class'=>'btn btn-xs btn-danger deleteBtnCategory', 'type'=>'submit', 'data-id' => $cat->id]) }}

                                    {{Form::close()}}
                                </td>
                            </tr>
                        @endforeach
                        </tbody> <!-- end #categoryDivBox -->
                    </table>
                    <div class="text-left">
                    </div>
                </div> <!-- end div #divProductTable -->
            </div> <!-- end 12 -->
        </div> <!-- end div .panel-body -->
    </div> <!-- end div .panel -->
@endsection
