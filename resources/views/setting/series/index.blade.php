@extends('layouts.app')
@section('title', '| Listado de Series')
@section('content')
    <div class="col-md-12 ">
        <div class="panel panel-default">
            <div class="panel-heading" style="margin-bottom: 0;padding-bottom: 0;">
                
                <h3 class="text-center text-info">@lang('series.title')</h3>
            </div>
            <div class="panel-body" style="padding-top: 0;">
            <a type="button" class="btn btn-info" href="{{url('series/agregar')}}"><i class="fa fa-plus-circle" aria-hidden="true"> </i> @lang('series.add')</a>
                <div class="col-md-4" id="searchDiv">
                    <div id="custom-search-input">
                        <div class="input-group ">
                            <input type="text" class="form-control input-md" id="SearchSeries" name="search"
                                   placeholder="Denominacion - Ejemplo : B001"/>
                            <span class="input-group-btn">
                         <button class="btn btn-info btn-md" type="button">
                         <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                     </span>
                        </div>
                    </div>
                </div>  <!-- end div #searchDiv -->
                <!-- Table -->
                <div class="col-md-12 col-sm-12">
                    <div class="table-responsive" id="divProductTable">
                        <table class="table table-responsive results">
                            <tr>
                                <th>
                                    @lang('series.tipodocumento')
                                </th>
                                <th>
                                    @lang('series.denominacion')
                                </th>
                                <th>
                                    @lang('series.correlativo')
                                </th>
                                <th>
                                    @lang('series.date')
                                </th>
                            </tr>
                            <tbody id="salesDivBoxAjax">
                            </tbody>
                            <tbody id="salesDivBox">
                            @foreach($series as $serie)
                                <tr>
                                    <td>
                                        {{  $serie->descripcion_tipo_documento   }}
                                    </td>
                                    <td style="word-break: break-all;">
                                        {{  $serie->cDenominacionSerie }}
                                    </td>
                                    <td>
                                        {{  $serie->nCorrelativo }}
                                    </td>
                                    <td>
                                        {{  date('d-M-Y', strtotime($serie->updated_at)) }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div> <!-- end div #divProductTable -->
                </div> <!-- end col 12-->

                <!-- Print page -->
                <script>
                    /*
                     Products search
                     */

                    //Language
                    $(function () {
                        $("#SearchSeries").keyup(function () {
                            var _search = $(this).val();
                            if (_search === '') {
                                $('#salesDivBoxAjax').hide();
                                $('#salesDivBox').show();
                                return false;
                            }
                            $.ajax({
                                type: 'POST',
                                dataType: "json",
                                url: '/series/search',
                                data: {
                                    '_token': $('input[name=_token]').val(),
                                    'search': _search
                                },
                                success: function (data) {
                                    var $a;
                                    $.each(data, function (i, result) {
                                        if (jQuery.isEmptyObject(result.RoleOwners)) {
                                            $('#salesDivBox').hide();
                                            $('#salesDivBoxAjax').show();
                                            $a += '<tr>',
                                                $a += '<td >' + result.descripcion_tipo_documento + '</td >',
                                                $a += '<td >' + result.cDenominacionSerie + '</td >',
                                                $a += '<td >' + result.nCorrelativo + '</td >',
                                                $a += '<td >' + result.updated_at + '</td >'
                                        }
                                    });
                                    $('tbody#salesDivBoxAjax').html($a);
                                }
                            });
                        });


                    });
                </script>
            </div>
        </div>
    </div>
@endsection

