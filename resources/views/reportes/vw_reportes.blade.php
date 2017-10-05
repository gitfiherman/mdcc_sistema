@extends('layouts.app')
@section('content')

    <section id="widget-grid" class="">
        <div class='cr_content col-xs-12'>
            <div class="col-xs-12">
                <div class="col-lg-9">
                    <h1 class="txt-color-green"><b>Listado de Reportes Principales...</b></h1>
                </div>
                <div class="col-lg-3 col-md-6 col-xs-12">
                </div>

            </div>
            <div class="col-lg-3 col-md-6 col-xs-12">
            </div>

            <div class="col-lg-3 col-md-6 col-xs-12">
            </div>
            <div class="col-lg-6 col-md-12 col-xs-12">
                <!--
                <ul class="text-right" style="margin-top: 22px !important; margin-bottom: 0px !important">
                    <button onclick="open_dialog_new_edit_Contribuyente('NUEVO');" id="btn_vw_contribuyentes_Nuevo" type="button" class="btn btn-labeled bg-color-greenLight txt-color-white">
                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                    </button>
                    <button onclick="modificar_contrib();" id="btn_vw_contribuyentes_Editar" type="button" class="btn btn-labeled bg-color-blue txt-color-white">
                        <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                    </button>
                    <button id="btn_vw_contribuyentes_Eliminar" type="button" class="btn btn-labeled btn-danger">
                        <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Eliminar
                    </button>
                    <button onclick="dlg_new_reporte();" type="button" class="btn btn-labeled bg-color-magenta txt-color-white">
                        <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Imprimir
                    </button>
                    <button onclick="reniec();" type="button" class="btn btn-labeled bg-color-magenta txt-color-white">
                        <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Reniec
                    </button>
                </ul>
                -->
            </div>
        </div>
        <!-- row -->
        <div class="row">

            <div class="col-sm-12">

                <div class="well">

                    <table class="table table-striped table-forum">
                        <thead>
                        <tr>
                            <th colspan="2" style="width: 60%;">Contribuyentes</th>
                            <th class="text-center hidden-xs hidden-sm" style="width: 10%;">Visto</th>
                            <th class="hidden-xs hidden-sm"style="width: 30%;">Última vez</th>
                        </tr>
                        </thead>
                        <tbody>

                        <!-- TR -->
                        <tr>
                            <td class="text-center" style="width: 40px;"><i class="fa fa-group fa-2x text-muted"></i></td>
                            <td>
                                <h4><a href="#" onclick="dlg_new_reporte_0(0);" id="titulo_r1">
                                        Listado de principales contribuyentes
                                    </a>
                                    <small>Descripción reporte 0</small>
                                </h4>
                            </td>
                            <td class="text-center hidden-xs hidden-sm">
                                <a href="javascript:void(0);">431 veces</a>
                            </td>
                            <td class="hidden-xs hidden-sm">Por
                                <a href="javascript:void(0);">{{ Auth::user()->ape_nom }}</a>
                                <br>
                                <small><i>January 1, 2014</i></small>
                            </td>
                        </tr>
                        <!-- end TR -->


                        <!-- TR -->
                        <tr>
                            <td class="text-center" style="width: 40px;"><i class="fa fa-group fa-2x text-muted"></i></td>
                            <td>
                                <h4><a href="#" onclick="dlg_new_reporte(1);" id="titulo_r1">
                                        Listado de datos de los contribuyentes.
                                    </a>
                                    <small>Descripción reporte 1</small>
                                </h4>
                            </td>
                            <td class="text-center hidden-xs hidden-sm">
                                <a href="javascript:void(0);">431 veces</a>
                            </td>
                            <td class="hidden-xs hidden-sm">Por
                                <a href="javascript:void(0);">{{ Auth::user()->ape_nom }}</a>
                                <br>
                                <small><i>January 1, 2014</i></small>
                            </td>
                        </tr>
                        <!-- end TR -->

                        <!-- TR -->
                        <tr>
                            <td class="text-center" style="width: 40px;"><i class="fa fa-group fa-2x text-muted"></i></td>
                            <td>
                                <h4><a href="#" onclick="dlg_new_reporte(2);" id="titulo_r2">
                                        Listado de datos contribuyentes y predios.
                                    </a>
                                    <small>Descripción reporte 2</small>
                                </h4>
                            </td>
                            <td class="text-center hidden-xs hidden-sm">
                                <a href="javascript:void(0);">431 veces</a>
                            </td>
                            <td class="hidden-xs hidden-sm">Por
                                <a href="javascript:void(0);">{{ Auth::user()->ape_nom }}</a>
                                <br>
                                <small><i>January 1, 2014</i></small>
                            </td>
                        </tr>

                        <!-- TR -->
                        <tr>
                            <td class="text-center" style="width: 40px;"><i class="fa fa-group fa-2x text-muted"></i></td>
                            <td>
                                <h4><a href="#" onclick="dlg_new_reporte_4(4);" id="titulo_r2">
                                        Reporte de cantidad de contribuyentes y predios por zonas.
                                    </a>
                                    <small>Descripción reporte 2</small>
                                </h4>
                            </td>
                            <td class="text-center hidden-xs hidden-sm">
                                <a href="javascript:void(0);">431 veces</a>
                            </td>
                            <td class="hidden-xs hidden-sm">Por
                                <a href="javascript:void(0);">{{ Auth::user()->ape_nom }}</a>
                                <br>
                                <small><i>January 1, 2014</i></small>
                            </td>
                        </tr>
                        <!-- end TR -->
                        </tbody>
                    </table>

                </div>
            </div>

        </div>

        <!-- end row -->
    </section>
@section('page-js-script')

<script type="text/javascript">
    $(document).ready(function () {
        $("#menu_reportes").show();
        $("#li_ver_reportes").addClass('cr-active');

        $("#range-slider-1").ionRangeSlider({
            min: 0,
            max: 100000,
            from: 0,
            to: 50000,
            type: 'double',
            step: 1,
            postfix: "Soles",
            prettify: false,
            grid: true,
            inputValuesSeparator: ';'
        });


    });
</script>
@stop
<script src="{{ asset('Js/plugin/ion-slider/ion.rangeSlider.min.js')}}"></script>
<script src="{{ asset('archivos_js/reportes/reportes.js') }}"></script>

<div id="dialog_reporte_contr" style="display: none">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">
                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body">

                        <p id="descripcion_subtitulo">

                        </p>
                        <hr class="simple">
                        <ul id="myTab1" class="nav nav-tabs bordered">
                            <li class="active">
                                <a href="#s1" onclick="current_tab(1);" data-toggle="tab">Año-Sector-Manzana</a>
                            </li>
                            <li>
                                <a href="#s2" onclick="current_tab(2);" data-toggle="tab">Habilitación Urbana</a>
                            </li>

                        </ul>

                        <div id="myTabContent1" class="tab-content padding-10">
                            <div class="tab-pane fade in active" id="s1">
                                <div class="row">
                                    <section class="col col-4" style="padding-right:5px;">
                                        <label class="label">AÑO:</label>
                                        <label class="select">
                                            <select id='selantra' class="form-control col-lg-8">
                                                @foreach ($anio_tra as $anio)
                                                    <option value='{{$anio->anio}}' >{{$anio->anio}}</option>
                                                @endforeach
                                            </select><i></i> </label>
                                    </section>
                                    <section class="col col-4" style="padding-left:5px;padding-right:5px;">
                                        <label class="label">SECTOR:</label>
                                        <label class="select">
                                            <select id='selsec' class="form-control col-lg-8" onchange="callpredtab();">
                                                @foreach ($sectores as $sectores)
                                                    <option value='{{$sectores->id_sec}}' >{{$sectores->sector}}</option>
                                                @endforeach
                                            </select><i></i> </label>
                                    </section>
                                    <section class="col col-4" id="div_mzna" style="padding-left:5px;padding-right:5px">
                                        <label class="label">MANZANA:</label>
                                        <label class="select">
                                            <select id="selmnza" class="form-control" >
                                                <option value='0'>-- TODOS --</option>
                                                @foreach ($manzanas as $manzanas)
                                                    <option value='{{$manzanas->codi_mzna}}'>{{$manzanas->codi_mzna}}</option>
                                                @endforeach
                                            </select><i></i> </label>
                                    </section>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="s2">

                                <div class="row">
                                <section class="col col-2" style="padding-right:5px;">
                                    <label class="label">AÑO:</label>
                                    <label class="select">
                                        <select id='selec_hab_urb' class="form-control col-lg-8">
                                            @foreach ($anio_tra as $anio)
                                                <option value='{{$anio->anio}}' >{{$anio->anio}}</option>
                                            @endforeach
                                        </select><i></i> </label>
                                </section>

                                <section class="col col-10">
                                    <label class="label">Habilitación Urbana:</label>
                                    <label class="input">
                                        <input type="hidden" id="hiddentxt_hab_urb">
                                        <input id="hab_urb" type="text" placeholder="Avenida, Jiron, Calle o Pasaje." class="input-sm">
                                       <!-- <input type="text" list="list" id="hab_urb" name="hab_urb" placeholder="Habilitación Urbana">
                                        <datalist id="list">
                                            @foreach ($hab_urb as $hab)
                                                <option data-xyz ="{{$hab->id_hab_urb}}" value="{{$hab->nomb_hab_urba}}">{{$hab->id_hab_urb}}</option>
                                            @endforeach
                                        </datalist> -->
                                        </label>
                                </section>
                                    </div>

                            </div>
                        </div>

                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->
            </div>
        </div>
    </div>
</div>

<div id="dialog_reporte_contr_4" style="display: none">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">
                <div class="row">
                    <section class="col col-3">

                    </section>
                    <section class="col col-6" style="padding-right:5px;">
                        <label class="label">AÑO:</label>
                        <label class="select">
                            <select id='selan_r4' class="form-control">
                                @foreach ($anio_tra as $anio_4)
                                    <option value='{{$anio_4->anio}}' >{{$anio_4->anio}}</option>
                                @endforeach
                            </select><i></i> </label>
                    </section>
                    <section class="col col-3">

                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="dialog_reporte_contr_0" style="display: none">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">


                <div class="row" style="padding-left: 30px;padding-right: 35px">
                    <label class="label" style="text-align: center">RANGO:</label>

                                <input id="range-slider-1" type="text" name="range_1" value="">
                </div>

                <br>
                <div class="row" style="padding-left: 15px;padding-right: 35px">
                    <section class="col col-3" style="padding-right:5px;">
                        <label class="label">AÑO:</label>
                        <label class="select">
                            <select id='selantra_r0' class="form-control col-lg-8">
                                @foreach ($anio_tra as $anio)
                                    <option value='{{$anio->anio}}' >{{$anio->anio}}</option>
                                @endforeach
                            </select><i></i> </label>
                    </section>
                    <section class="col col-3">
                        <label class="label">MIN:</label>
                        <label class="input">
                            <input id="min" type="text" placeholder="0" class="input-sm">
                        </label>
                    </section>
                    <section class="col col-3">
                        <label class="label">MAX:</label>
                        <label class="input">
                            <input id="max" type="text" placeholder="50 000" class="input-sm">
                        </label>
                    </section>
                    <section class="col col-3">
                        <label class="label">REGISTROS:</label>
                        <label class="input">
                            <input id="num_reg" type="text" placeholder="10" class="input-sm">
                        </label>
                    </section>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>


@endsection



