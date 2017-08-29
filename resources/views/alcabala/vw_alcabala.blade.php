@extends('layouts.app')
@section('content')
<section id="widget-grid" class=""> 
    <div class='cr_content col-xs-12 '>
        <h1 class="txt-color-green"><b>Registro de Alcabala...</b></h1>

        <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-4" style="padding: 0px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 5px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                <h2>Busqueda Alcabala por Año</h2>
                        </header>
                    </div>
                </section>
                <div class="col-xs-6" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Periodo</span>
                        <div class="icon-addon addon-md">
                            <select id='selan' class="form-control col-lg-8" style="height: 32px;">
                            @foreach ($anio_tra as $anio)
                            <option value='{{$anio->anio}}' >{{$anio->anio}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class='col-lg-6'style="padding: 0px;" >
                    <button type="button" class="btn btn-labeled bg-color-green txt-color-white" onclick="fn_bus_ani()">
                        <span class="btn-label"><i class="glyphicon glyphicon-search"></i></span>Buscar por Año
                    </button>
                </div>
            </div>
            <div class="col-xs-12 col-md-12 col-lg-8" style="padding: 0px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 5px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                <h2>Busqueda por Comprador</h2>
                        </header>
                    </div>
                </section>
                <div class="col-xs-4" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Cod.</span>
                        <div class=""  >
                            <input id="dlg_contri_com_hidden" type="hidden" value="0">
                            <input id="dlg_dni_com" type="text"  class="form-control" style="height: 32px; " >
                        </div>

                    </div>
                </div>
                <div class="col-xs-8" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Comprador</span>
                        <div   >
                            <input id="dlg_contri_com" type="text"  class="form-control" style="height: 32px;font-size: 0.9em;width: 102% !important"  >
                        </div>
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" onclick="fn_bus_contrib()">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </span>
                    </div>
                </div>
                
            </div>
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 5px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                <h2>Busqueda por Vendedor</h2>
                        </header>
                    </div>
                </section>
                <div class="col-xs-4" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Cod.</span>
                        <div class=""  >
                            <input id="dlg_contri_ven_hidden" type="hidden" value="0">
                        <input id="dlg_dni_ven" type="text"  class="form-control" style="height: 32px; " >
                        </div>

                    </div>
                </div>
                <div class="col-xs-8" style="padding: 0px; ">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Vendedor</span>
                        <div   >
                            <input id="dlg_contri_ven" type="text"  class="form-control" style="height: 32px;font-size: 0.9em;width: 102% !important" >
                        </div>
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" onclick="fn_bus_contrib()">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </span>
                    </div>
                </div>
                
            </div>
            
            <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
            <article class="col-xs-10" style=" padding: 0px !important">
                    <table id="table_alcab"></table>
                    <div id="pager_table_alcab"></div>
            </article>
            <div class="col-xs-2">
                <button class="btn bg-color-green txt-color-white cr-btn-big" onclick="fn_new();" >
                    <span style="left: -28px;" >
                        <i class="glyphicon glyphicon-plus-sign"></i>
                    </span>
                    <label>Nuevo</label>
                </button>
            </div>
            </div>
            
            
        </div>
        
    </div>
    
    
</section>
@section('page-js-script')
<script type="text/javascript">
    $(document).ready(function (){
        $("#menu_alcabala").show();
        $("#li_alcabala").addClass('cr-active')
        jQuery("#table_alcab").jqGrid({
            url: 'trae_acabala/'+$("#selan").val(),
            datatype: 'json', mtype: 'GET',
            height: '230px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_alcab', 'N° Alcabala', 'Comprador', 'Vendedor','Predio', 'Fec. Alcab','Ver'],
            rowNum: 20, sortname: 'id_alcab', sortorder: 'desc', viewrecords: true, caption: 'Lista de Alcabalas', align: "center",
            colModel: [
                {name: 'id_alcab', index: 'id_alcab', hidden: true},
                {name: 'nro_alcab', index: 'nro_alcab', align: 'center', width: 80},
                {name: 'id_adqui', index: 'id_cont_compr', align: 'center', width: 80},
                {name: 'id_trans', index: 'id_cont_vend', align: 'center', width: 80},
                {name: 'id_pred', index: 'id_pred', align: 'center', width: 80},
                {name: 'fecha_reg', index: 'fecha_reg', align: 'center', width: 80},
                {name: 'ver', index: 'ver', align: 'center', width: 80},
            ],
            pager: '#pager_table_alcab',
            rowList: [13, 20],
            gridComplete: function () {
                    var idarray = jQuery('#table_alcab').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_alcab').jqGrid('getDataIDs')[0];
                            $("#table_alcab").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
        jQuery("#table_contrib").jqGrid({
            url: 'obtiene_cotriname?dat=0',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_pers','codigo','DNI/RUC','contribuyente','Dom. Fiscal','Doc. Conyuge','Conyuge'],
            rowNum: 20, sortname: 'contribuyente', sortorder: 'asc', viewrecords: true, caption: 'Contribuyentes', align: "center",
            colModel: [
                {name: 'id_pers', index: 'id_pers', hidden: true},
                {name: 'id_per', index: 'id_per', align: 'center',width: 90},
                {name: 'nro_doc', index: 'nro_doc', align: 'center',width: 70},
                {name: 'contribuyente', index: 'contribuyente', align: 'left',width: 240},
                {name: 'dom_fiscal', index: 'dom_fiscal', align: 'left',width: 100},
                {name: 'nro_doc_conv', index: 'nro_doc_conv', align: 'left',width: 90},
                {name: 'conviviente', index: 'conviviente', align: 'left',width: 150},
                
            ],
            pager: '#pager_table_contrib',
            rowList: [13, 20],
            gridComplete: function () {
                    var idarray = jQuery('#table_contrib').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_contrib').jqGrid('getDataIDs')[0];
                            $("#table_contrib").setSelection(firstid);    
                        }
                    jQuery('#table_contrib').jqGrid('bindKeys', {"onEnter":function( rowid ){fn_ctb_list_alcab(rowid);} } ); 
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){fn_ctb_list_alcab(Id)}
        });
        $("#dlg_adquiere_cod").keypress(function (e) {
            if (e.which == 13) {
                get_ctb_cod_alcab("dlg_adquire",$("#dlg_adquiere_cod").val());
            }
        });
        $("#dlg_trans_cod").keypress(function (e) {
            if (e.which == 13) {
                get_ctb_cod_alcab("dlg_trans",$("#dlg_trans_cod").val());
            }
        });
        var globalvalidador=0;
        $("#dlg_adquire").keypress(function (e) {
            if (e.which == 13) {
                if(globalvalidador==0)
                {
                    fn_ctb_alcab("dlg_adquire");
                    globalvalidador=1;
                }
                else
                {
                    globalvalidador=0;
                }
            }
        });
        $("#dlg_trans").keypress(function (e) {
            if (e.which == 13) {
                if(globalvalidador==0)
                {
                    fn_ctb_alcab("dlg_trans");
                    globalvalidador=1;
                }
                else
                {
                    globalvalidador=0;
                }
            }
        });
    });
</script>
@stop
<script src="{{ asset('archivos_js/alcabala/alcabala.js') }}"></script>
<div id="dlg_bus_contr" style="display: none;">
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:5px; margin-bottom: 10px; padding: 0px !important">
        <table id="table_contrib"></table>
        <div id="pager_table_contrib"></div>
    </article>
</div>
<div id="dlg_new_alcabala" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div id="div_adquiere" class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-user"></i> </span>
                                <h2>Datos Contribuyente que Adquiere ::..</h2>
                        </header>
                    </div>
                </section>
                <div class="col-xs-3" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Codigo</span>
                        <div class=""  >
                            <input id="dlg_adquire_hidden" type="hidden" value="0">
                            <input id="dlg_adquire_cod" type="text"  class="form-control" style="height: 32px; " >
                        </div>
                    </div>
                </div>
                <div class="col-xs-9" style="padding: 0px; ">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Contribuyente que Adquiere</span>
                        <div>
                            <input id="dlg_adquire" type="text"  class="form-control" style="height: 32px;font-size: 0.9em;width: 102% !important" autofocus="focus" >
                        </div>
                        <span class="input-group-btn" style="font-size: 13px;">
                            <button class="btn btn-default" type="button" onclick="fn_bus_contrib()">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </span>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 10px;"></div>
                <div class="col-xs-3" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">N° Doc.</span>
                        <div class=""  >
                            <input id="dlg_adquire_doc" type="text"  class="form-control" style="height: 32px; " disabled="" >
                        </div>
                    </div>
                </div>
                <div class="col-xs-9" style="padding: 0px; ">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Domicilio Fiscal</span>
                        <div>
                            <input id="dlg_adquire_dom" type="text"  class="form-control" style="height: 32px;font-size: 0.9em;" disabled="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-user"></i> </span>
                                <h2>Datos Conyuge ::..</h2>
                        </header>
                    </div>
                </section>
                <div class="col-xs-3" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">N° Doc.</span>
                        <div class=""  >
                            <input id="dlg_adquiere_doc_conv" type="text"  class="form-control" style="height: 32px; " disabled="" >
                        </div>
                    </div>
                </div>
                <div class="col-xs-9" style="padding: 0px; ">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Nombre</span>
                        <div>
                            <input id="dlg_adquire_conv" type="text"  class="form-control" style="height: 32px;font-size: 0.9em;" disabled="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px;margin-bottom: 10px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-user"></i> </span>
                                <h2>Datos Representante Legal ::..</h2>
                        </header>
                    </div>
                </section>

                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Datos</span>
                        <div>
                            <input id="dlg_adquire_rep" type="text"  class="form-control" style="height: 32px;font-size: 0.9em;" placeholder="DNI-Nombre-Documento que Autoriza" maxlength="100" >
                        </div>
                    </div>
                </div>
            </div>
            <ul id="sparks" >
                <button type="button" class="btn btn-labeled bg-color-green txt-color-white" onclick="next(1)">
                    <span class="cr-btn-label"><i class="glyphicon glyphicon-forward"></i></span>Siguiente
                </button>
            </ul>
        </div>
        <div id="div_trans" class="col-xs-12 cr-body" style="display: none;" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-teal" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                                <h2>Datos Contribuyente que Transfieres ::..</h2>
                        </header>
                    </div>
                </section>
                <div class="col-xs-3" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Codigo</span>
                        <div class=""  >
                            <input id="dlg_trans_hidden" type="hidden" value="0">
                        <input id="dlg_trans_cod" type="text"  class="form-control" style="height: 32px; " >
                        </div>
                    </div>
                </div>
                <div class="col-xs-9" style="padding: 0px; ">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Transferente</span>
                        <div>
                            <input id="dlg_trans" type="text"  class="form-control" style="height: 32px;font-size: 0.9em;width: 102% !important" autofocus="focus" >
                        </div>
                        <span class="input-group-btn" style="font-size: 13px;">
                            <button class="btn btn-default" type="button" onclick="fn_bus_contrib()">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </span>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 10px;"></div>
                <div class="col-xs-3" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">N° Doc.</span>
                        <div class=""  >
                            <input id="dlg_trans_doc" type="text"  class="form-control" style="height: 32px; " disabled="" >
                        </div>
                    </div>
                </div>
                <div class="col-xs-9" style="padding: 0px; ">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Domicilio Fiscal</span>
                        <div>
                            <input id="dlg_trans_dom" type="text"  class="form-control" style="height: 32px;font-size: 0.9em;" disabled="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-teal" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                                <h2>Datos Conyuge ::..</h2>
                        </header>
                    </div>
                </section>
                <div class="col-xs-3" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">N° Doc.</span>
                        <div class=""  >
                            <input id="dlg_trans_doc_conv" type="text"  class="form-control" style="height: 32px; " disabled="" >
                        </div>
                    </div>
                </div>
                <div class="col-xs-9" style="padding: 0px; ">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Nombre</span>
                        <div>
                            <input id="dlg_trans_conv" type="text"  class="form-control" style="height: 32px;font-size: 0.9em;" disabled="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px;margin-bottom: 10px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-teal" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                                <h2>Datos Representante Legal ::..</h2>
                        </header>
                    </div>
                </section>

                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Datos</span>
                        <div>
                            <input id="dlg_trans_rep" type="text"  class="form-control" style="height: 32px;font-size: 0.9em;" placeholder="DNI-Nombre-Documento que Autoriza" maxlength="100" >
                        </div>
                    </div>
                </div>
            </div>
            <ul id="sparks" >
                <button type="button" class="btn btn-labeled bg-color-green txt-color-white" onclick="back(1)">
                    <span class="cr-btn-label"><i class="glyphicon glyphicon-backward"></i></span>Anterior
                </button>
                <button type="button" class="btn btn-labeled bg-color-teal txt-color-white" onclick="next(2)">
                    <span class="cr-btn-label"><i class="glyphicon glyphicon-forward"></i></span>Siguiente
                </button>
            </ul>
        </div>
        <div id="div_pred" class="col-xs-12 cr-body" style="display: none;" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-bottom: 10px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-home"></i> </span>
                                <h2>Datos del Predio a Transferir::..</h2>
                        </header>
                    </div>
                </section>
                <div class="col-xs-9" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Predio a Transferir</span>
                        <div class=""  >
                            <select id='selpredios' class="form-control col-lg-8" style="height: 32px;" onchange="fn_cal_pred()">
                            
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-3" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">% Adquirido</span>
                        <div>
                            <input id="dlg_por_adquirido" type="text"  class="form-control" style="height: 32px;font-size: 0.9em;" onkeypress="return soloNumeroTab(event);"  >
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Naturaleza Contrato</span>
                        <div class=""  >
                            <select id='selcontrato' class="form-control col-lg-8" style="height: 32px;">
                            @foreach ($contrato as $con)
                            <option value='{{$con->id_tip_cto}}' >{{$con->descrip_cto}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                
                
                <div class="col-xs-7" style="padding: 0px; margin-top: 10px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Tipo Doc. Transferencia</span>
                        <div class=""  >
                            <select id='selcontrato' class="form-control col-lg-8" style="height: 32px;">
                            @foreach ($transferencia as $trans)
                            <option value='{{$trans->id_doc_transf}}' >{{$trans->descrip_doc_transf}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-5" style="padding: 0px; margin-top: 10px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Fecha Transferencia:</span>
                        <div class="icon-addon addon-md">
                            <input id="dlg_fec_trans" type="text" name="request" placeholder="Ingresar Fecha" class="datepicker" data-dateformat='dd/mm/yy' style="height: 32px; padding-left: 5px;width: 100%;">
                        </div>
                    </div>
                </div>
                              

                <div class="col-xs-12" style="padding: 0px; margin-top: 10px; ">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Nombre Notaría</span>
                        <div>
                            <input id="dlg_notaria" type="text"  class="form-control" style="height: 32px;font-size: 0.9em;" >
                        </div>
                    </div>
                </div>
            </div>
            
           
            <ul id="sparks" >
                <button type="button" class="btn btn-labeled bg-color-teal txt-color-white" onclick="back(2)">
                    <span class="cr-btn-label"><i class="glyphicon glyphicon-backward"></i></span>Anterior
                </button>
                <button type="button" class="btn btn-labeled bg-color-green txt-color-white" onclick="next(3)">
                    <span class="cr-btn-label"><i class="glyphicon glyphicon-forward"></i></span>Siguiente
                </button>
            </ul>
        </div>
        <div id="div_calculos" class="col-xs-12 cr-body" style="display: none;" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-bottom: 10px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-money"></i> </span>
                                <h2>Calculos de Alcabala::..</h2>
                        </header>
                    </div>
                </section>
                <div class="col-xs-4" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Autovaluo Año Actual</span>
                        <div>
                            <input id="dlg_autovaluo" type="text"  class="form-control text-align-right" style="height: 32px;font-size: 0.9em;" disabled=""  >
                        </div>
                    </div>
                </div>
                <div class="col-xs-4" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">% Adquirido</span>
                        <div>
                            <input id="dlg_por_aplicado" type="text"  class="form-control text-align-right" style="height: 32px;font-size: 0.9em;" disabled=""  >
                        </div>
                    </div>
                </div>
                <div class="col-xs-4" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Autovaluo Aplicado</span>
                        <div>
                            <input id="dlg_autovaluo_aplicado" type="text"  class="form-control text-align-right" style="height: 32px;font-size: 0.9em;" disabled=""  >
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-bottom: 10px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-money"></i> </span>
                                <h2>Valores de Transferencia::..</h2>
                        </header>
                    </div>
                </section>
                <div class="col-xs-4" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Precio Transferencia</span>
                        <div>
                            <input id="dlg_pre_trans" type="text"  class="form-control text-align-right" style="height: 32px;font-size: 0.9em;" onkeypress="return soloNumeroTab(event);" onkeyup="validarventa();" >
                        </div>
                    </div>
                </div>
                <div class="col-xs-4" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Moneda</span>
                        <div>
                            <select id='selmonedas' class="form-control col-lg-8" style="height: 32px;" onchange="fn_cam_mon()">
                                <option value="1" tp="1">S/. Nuevos Soles</option>
                                <option value="2" tp="">$ Dolares Americanos</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Tipo Cambio</span>
                        <div>
                            <input id="dlg_tip_cam" type="text"  class="form-control text-align-right" style="height: 32px;font-size: 0.9em;" onkeypress="return soloNumeroTab(event);" onkeyup="validarventa()" >
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Precio de Transferencia en Soles</span>
                        <div>
                            <input id="dlg_val_tot_soles" type="text"  class="form-control text-align-right" style="height: 32px;font-size: 0.9em;" disabled="" >
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-bottom: 10px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-money"></i> </span>
                                <h2>Valores Aplicables::..</h2>
                        </header>
                    </div>
                </section>
                <div class="col-xs-12" style="padding: 0px; margin-bottom: 10px ;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Base imponible aplicable (El mas Alto entre 1 y 2)</span>
                        <div>
                            <input id="dlg_bi_apli" type="text"  class="form-control text-align-right" style="height: 32px;font-size: 0.9em;" disabled="" >
                        </div>
                    </div>
                </div>
                
                <div class="col-xs-3" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Valor UIT {{$UIT->anio}}</span>
                        <div>
                            <input id="dlg_uit" type="text"  class="form-control text-align-right" style="height: 32px;font-size: 0.9em;" disabled="" value="{{number_format($UIT->uit,2)}}" >
                        </div>
                    </div>
                </div>
                <div class="col-xs-3" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">UITs Deducibles</span>
                        <div>
                            <input id="dlg_nro_uit" type="text"  class="form-control text-align-right" style="height: 32px;font-size: 0.9em;" disabled="" value="{{number_format($deduc->nro_uit,2)}}" >
                        </div>
                    </div>
                </div>
                <div class="col-xs-3" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Total Deducible</span>
                        <div>
                            <input id="dlg_tot_deduc" type="text"  class="form-control text-align-right" style="height: 32px;font-size: 0.9em;" disabled="" value="{{number_format($UIT->uit*$deduc->nro_uit,2)}}" >
                        </div>
                    </div>
                </div>
                <div class="col-xs-3" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Total Base Afecta</span>
                        <div>
                            <input id="dlg_bi_afecta" type="text"  class="form-control text-align-right" style="height: 32px;font-size: 0.9em;" disabled="" >
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-bottom: 10px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-money"></i> </span>
                                <h2>Datos Para el Calculo del Impuesto::..</h2>
                        </header>
                    </div>
                </section>
                <div class="col-xs-6" style="padding: 0px; ">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Tasa del Impuesto</span>
                        <div>
                            <input id="dlg_tasa_imp" type="text" value="{{$tasa->por_tas}}"  class="form-control text-align-right" style="height: 32px;font-size: 0.9em;" disabled="" >
                        </div>
                    </div>
                </div>
                <div class="col-xs-6" style="padding: 0px; ">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Total de Impuesto a Pagar</span>
                        <div>
                            <input id="dlg_tot_pago" type="text"  class="form-control text-align-right" style="height: 32px;font-size: 0.9em;" disabled="" >
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="padding: 0px; margin-top: 10px ;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Tipo de Inafectación</span>
                        <div>
                            <select id='selinafec' class="form-control col-lg-8" style="height: 32px;">
                            @foreach ($inafecto as $inafec)
                            <option value='{{$inafec->id_trans_inaf}}' >{{$inafec->descrip_trans_inaf}}</option>
                            @endforeach
                            </select>                       
                        </div>
                    </div>
                </div>
                
                
                
            </div>
            <ul id="sparks" >
                <button type="button" class="btn btn-labeled bg-color-green txt-color-white" onclick="back(3)">
                    <span class="cr-btn-label"><i class="glyphicon glyphicon-backward"></i></span>Anterior
                </button>
                <button type="button" class="btn btn-labeled bg-color-green txt-color-white" onclick="next(4)">
                    <span class="cr-btn-label"><i class="glyphicon glyphicon-forward"></i></span>Siguiente
                </button>
            </ul>
        </div>
        <div id="div_final" class="col-xs-12 cr-body" style="display: none;" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-bottom: 10px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-warning"></i> </span>
                                <h2>Creación de Alcabala::..</h2>
                        </header>
                    </div>
                </section>
                <div class="col-xs-12" style="padding: 0px;;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Atencion</span>
                        <div>
                            <span class="col-xs-12" style="text-align: justify">
                                <b>Atencion:</b> se procederá a generar el impuesto de Alcabala con los siguientes Datos, Si considera que algún dato es
                                incorrecto retroceder y corregir, de lo cotrario no podra borrarse la información.
                            </span>
                        </div>
                    </div>
                </div>
               
            </div>
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-bottom: 10px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-user"></i> </span>
                                <h2>Datos de Contribuyente que Adquiere::..</h2>
                        </header>
                    </div>
                </section>
                <div class="col-xs-4" style="padding: 0px; ">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">N° Documento</span>
                        <div>
                            <input id="dlg_fin_doc" type="text"  class="form-control" style="height: 32px;font-size: 0.9em;" disabled="">
                        </div>
                    </div>
                </div>
                <div class="col-xs-8" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Contribuyente</span>
                        <div>
                            <input id="dlg_fin_contrb" type="text"  class="form-control" style="height: 32px;font-size: 0.9em;" disabled="">
                        </div>
                    </div>
                </div>
               
            </div>
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-bottom: 10px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-money"></i> </span>
                                <h2>Datos de Calculo::..</h2>
                        </header>
                    </div>
                </section>
                <div class="col-xs-6"></div>
                <div class="col-xs-6" style="padding: 0px; ">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Base Imponible</span>
                        <div>
                            <input id="dlg_fin_base" type="text"  class="form-control text-align-right" style="height: 32px;font-size: 0.9em;" disabled="">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 10px;"></div>
                <div class="col-xs-6"></div>
                <div class="col-xs-6" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Monto deducido</span>
                        <div>
                            <input id="dlg_fin_dedu" type="text"  class="form-control text-align-right" style="height: 32px;font-size: 0.9em;" disabled="">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 10px;"></div>
                <div class="col-xs-6"></div>
                <div class="col-xs-6" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Base Imponible Afecta</span>
                        <div>
                            <input id="dlg_fin_afecta" type="text"  class="form-control text-align-right" style="height: 32px;font-size: 0.9em;" disabled="">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 10px;"></div>
                <div class="col-xs-6"></div>
                <div class="col-xs-6" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Impuesto a Pagar</span>
                        <div>
                            <input id="dlg_fin_pagar" type="text"  class="form-control text-align-right" style="height: 32px;font-size: 0.9em;" disabled="" >
                        </div>
                    </div>
                </div>
               
            </div>
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-bottom: 10px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-money"></i> </span>
                                <h2>Tipo de Inafectación</h2>
                        </header>
                    </div>
                </section>
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Tipo de Inafectación</span>
                        <div>
                            <input id="dlg_fin_inafecta" type="text"  class="form-control text-align-right" style="height: 32px;font-size: 0.9em;" disabled="">
                        </div>
                    </div>
                </div>
            </div>
            <ul id="sparks" >
                <button type="button" class="btn btn-labeled bg-color-green txt-color-white" onclick="back(4)">
                    <span class="cr-btn-label"><i class="glyphicon glyphicon-backward"></i></span>Anterior
                </button>
                <button type="button" class="btn btn-labeled bg-color-green txt-color-white" onclick="next(5)">
                    <span class="cr-btn-label"><i class="glyphicon glyphicon-check"></i></span>Finalizar
                </button>
            </ul>
        </div>
    </div>
</div> 





@endsection




