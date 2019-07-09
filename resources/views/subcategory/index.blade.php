@extends('layouts.app')
@section('title', '| Sub Categorías')
@section('content')

    <div class="panel panel-default">
        <h2 class="text-center text-info">@lang('subcategory.title')</h2>
        <div class="panel-body">
            <div id="tablePanel">
                <a href="{{url('/subcategory/create')}}">
                    <button class="btn btn-sm btn-info" data-id=""><i class="fa fa-plus-circle"
                                                                      aria-hidden="true"></i> @lang('subcategory.addcat')
                    </button>
                </a>
            </div> <!-- end div #tablePanel -->

            <div class="col-md-12">
                <div class="table-responsive" id="divProductTable">
                    <table class="table table-hover results">
                        <tr>
                            <th>#</th>
                            <th>@lang('subcategory.name')</th>
                            <th>Estado</th>
                            <th>Nombre de Categoría</th>
                            <th class="text-center" >@lang('subcategory.control')</th>
                        </tr>
                        <tbody class="table-responsive" id="categoryDivBox">
                        @foreach($subcategory as $cat)
                            <tr>
                                <td>{{  $cat->id   }}</td>
                                <td>{{  $cat->name }}</td>
                                {{-- <td>{{  date('d-M-Y-g:i ', strtotime($cat->created_at)) }}</td> --}}
                                <td>
                                    @if($cat->estado_id == 1)
                                        <span class="label label-success">
                                           {{$cat->nombre_estado}}
                                        </span>
                                    @else
                                        <span class="label label-danger">
                                           {{$cat->nombre_estado}}
                                        </span>
                                    @endif
                                </td>
                                <td>{{  $cat->nombrecategoria }}</td>
                                <td>
                                    <a href="{{route('subcategory.edit', $cat->id)}}">
                                        <button class="btn btn-xs btn-white"><i class="fa fa-pencil"
                                                                                aria-hidden="true"></i> @lang('button.edit')
                                        </button>
                                    </a>
                                    {{Form::open(['route' => ['subcategory.destroy', $cat->id], 'method' => 'DELETE' , 'id' => 'deleteFormSubCategory'])}}

                                    {{Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> '.trans('button.delete'), ['class'=>'btn btn-xs btn-danger deleteBtnSubCategory', 'type'=>'submit', 'data-id' => $cat->id]) }}

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
