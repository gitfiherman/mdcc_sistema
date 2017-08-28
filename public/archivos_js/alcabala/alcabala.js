function limpiar()
{
    
    $("#div_adquiere input").val("");
    $("#div_trans input").val("");
    $("#div_pred input").val("");
    $("#dlg_pre_trans").val("");
    $("#dlg_adquire_hidden, #dlg_trans_hidden, #selinafec").val(0);
    $("#selcontrato, #selcontrato, #selmonedas").val(1);
}
function fn_bus_ani()
{
    jQuery("#table_alcab").jqGrid('setGridParam', {url: 'trae_acabala/'+$("#selan").val()}).trigger('reloadGrid');
}
function fn_new()
{
    limpiar();
    $("#div_trans,#div_pred,#div_calculos,#div_final").hide();
    $("#div_adquiere").show("Explode");
    $("#dlg_adquire").focus();
    $("#dlg_new_alcabala").dialog({
        autoOpen: false, modal: true, width: 1000, 
        show:{ effect: "explode", duration: 500},
        hide:{ effect: "explode", duration: 800}, resizable: false,
        title: "<div class='widget-header'><h4><span class='widget-icon'> <i class='fa fa-align-justify'></i> </span> Registrar Nueva Alcabala</h4></div>"
        }).dialog('open');
}

function get_ctb_cod_alcab(input, doc) {
    MensajeDialogLoadAjax(input, '.:: Cargando ...');
    $.ajax({
        url: 'autocomplete_contrib?doc=0&cod='+doc,
        type: 'GET',
        success: function (data) {
            if (data.msg == 'si') {
                $("#" + input + "_hidden").val(data.id_pers);
                $("#" + input).val(data.contribuyente);
                $("#" + input+ "_dom").val(data.dom_fiscal);
                $("#" + input+ "_doc").val(data.nro_doc);
                $("#" + input+ "_doc_conv").val(data.nro_doc_conv);
                $("#" + input+ "_conv").val(data.conviviente);
            } else {
                $("#" + input + "_hidden").val(0);
                $("#" + input).val("");
                $("#" + input+ "_dom").val("");
                $("#" + input+ "_doc").val("");
                $("#" + input+ "_doc_conv").val("");
                $("#" + input+ "_conv").val("");
                mostraralertas('* El Documento Ingresado no Existe, registre al contribuyente o intente con otro número ... !');
            }
            MensajeDialogLoadAjaxFinish(input);
        },
        error: function (data) {
            mostraralertas('* Error Interno !  Comuniquese con el Administrador...');
            MensajeDialogLoadAjaxFinish(input);
        }
    });
}
var inputglobal="";
function fn_ctb_alcab(input)
{
    inputglobal=input;
    if($("#"+input).val()=="")
    {
        mostraralertasconfoco("Ingresar Información del Contribuyente para busqueda","#"+input); 
        return false;
    }
    if($("#"+input).val().length<4)
    {
        mostraralertasconfoco("Ingresar al menos 4 caracteres de busqueda","#"+input); 
        return false;
    }
    jQuery("#table_contrib").jqGrid('setGridParam', {url: 'obtiene_cotriname?dat='+$("#"+input).val()}).trigger('reloadGrid');

    $("#dlg_bus_contr").dialog({
        autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  Busqueda de Contribuyente :.</h4></div>"       
        }).dialog('open');
}
function fn_ctb_list_alcab(per)
{
    $("#"+inputglobal+"_hidden").val(per);
    $("#"+inputglobal+"_cod").val($('#table_contrib').jqGrid('getCell',per,'id_per'));
    $("#"+inputglobal).val($('#table_contrib').jqGrid('getCell',per,'contribuyente'));
    $("#"+inputglobal+"_doc").val($('#table_contrib').jqGrid('getCell',per,'nro_doc'));
    $("#"+inputglobal+"_dom").val($('#table_contrib').jqGrid('getCell',per,'dom_fiscal'));
    $("#"+inputglobal+"_doc_conv").val($('#table_contrib').jqGrid('getCell',per,'nro_doc_conv'));
    $("#"+inputglobal+"_conv").val($('#table_contrib').jqGrid('getCell',per,'conviviente'));
    if(inputglobal=="dlg_trans"){
        obtener_predios(per);
    }
    $("#dlg_bus_contr").dialog("close");
}
function obtener_predios(id)
{
     MensajeDialogLoadAjax("selpredios", '.:: Cargando ...');
    $.ajax({url: 'obtener_pred_ctb/'+id,
        type: 'GET',
        success: function(data) 
        {
            $("#selpredios").html("");
            $("#selpredios").append($('<option>',{value:0,text: "--Seleccione--", costo:0, autovaluo:0}));
            for (var i=0; i < data.length; i++)
            {
                var dir=data[i].sec+"-"+data[i].mzna+"-"+data[i].lote+"-"+data[i].nom_via;
                if(data[i].nro_mun!=""){
                    dir=dir+" Nro "+data[i].nro_mun;
                }
                if(data[i].mzna_dist!=""){
                    dir=dir+" Mzna "+data[i].mzna_dist;
                }
                if(data[i].lote_dist!=""){
                    dir=dir+" Lt "+data[i].lote_dist;
                }
                $("#selpredios").append($('<option>',{value:data[i].id_pred,text: dir, autovaluo:data[i].base_impon}));
            } 
            MensajeDialogLoadAjaxFinish("selpredios");
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            }
        });
}
function next(tipo)
{
    if(tipo==1)
    {
        if($("#dlg_adquire_hidden").val()==0){
            mostraralertasconfoco("Ingresar contribuyente","#dlg_adquire"); return false;
        }
        else{
            $("#div_adquiere,#div_pred,#div_calculos").hide("Explode");
            $("#div_trans").show("Explode");
            $("#dlg_trans").focus();
        }
    }
    if(tipo==2)
    {
        if($("#dlg_trans_hidden").val()==0){
            mostraralertasconfoco("Ingresar Transferente","#dlg_trans"); return false;
        }
        else{
            $("#selpredios").focus();
            $("#div_adquiere,#div_trans,#div_calculos").hide("Explode");
            $("#div_pred").show("Explode");
        }
    }
    if(tipo==3)
    {
        if($("#selpredios").val()==0){
            mostraralertasconfoco("Seleccione Predio","#selpredios");  return false;
        }
        if($("#dlg_por_adquirido").val()==0||$("#dlg_por_adquirido").val()==""||$("#dlg_por_adquirido").val()>100){
            mostraralertasconfoco("Ingresar Porcentaje Adquirido del Predio Correctamente","#dlg_por_adquirido");  return false;
        }
        if($("#dlg_fec_trans").val()==""){
            mostraralertasconfoco("Ingresar Fecha de Trasnferencia","#dlg_fec_trans"); return false;
        }
        if($("#dlg_notaria").val()==""){
            mostraralertasconfoco("Ingresar Nombre de Notaría","#dlg_notaria"); return false;
        }
        
        calculos();
        
        $("#div_adquiere,#div_trans,#div_pred").hide("Explode");
        $("#div_calculos").show("Explode");
        $("#dlg_pre_trans").focus();
    }
    if(tipo==4)
    {
        if($("#dlg_pre_trans").val()==""||$("#dlg_pre_trans").val()==0){
            mostraralertasconfoco("Ingresar Precio de Venta del Predio","#dlg_pre_trans");  return false;
        }
        if($("#dlg_tip_cam").val()==""||$("#dlg_tip_cam").val()==0){
            mostraralertasconfoco("Ingresar Tipo de cambio","#dlg_tip_cam");  return false;
        }
        $("#dlg_fin_doc").val($("#dlg_adquire_doc").val())
        $("#dlg_fin_contrb").val($("#dlg_adquire").val())
        $("#dlg_fin_base").val($("#dlg_bi_apli").val())
        $("#dlg_fin_dedu").val($("#dlg_tot_deduc").val())
        $("#dlg_fin_afecta").val($("#dlg_bi_afecta").val())
        $("#dlg_fin_pagar").val($("#dlg_tot_pago").val())
        $("#div_adquiere,#div_trans,#div_pred,#div_calculos").hide("Explode");
        $("#div_final").show("Explode");
    }
    if(tipo==5)
    {
        fn_confirmar();
    }
}
function calculos()
{
    fn_cam_mon();
    $("#dlg_bi_apli,#dlg_bi_afecta,#dlg_tot_pago").val("");
    $("#dlg_por_aplicado").val($("#dlg_por_adquirido").val());
    $("#dlg_autovaluo_aplicado").val(formato_numero(($("#dlg_autovaluo").val().replace(",","")*($("#dlg_por_adquirido").val()/100)),2,".",","));
}
function fn_cam_mon()
{
    
    $("#dlg_tip_cam").val($("#selmonedas option:selected").attr("tp"));
    validarventa();
}
function back(tipo)
{
    if(tipo==1){
        $("#div_trans,#div_pred,#div_calculos,#div_final").hide("Explode");
        $("#div_adquiere").show("Explode");
    }
    if(tipo==2){
        $("#div_adquiere,#div_pred,#div_calculos,#div_final").hide("Explode");
        $("#div_trans").show("Explode");
    }
    if(tipo==3){
        $("#div_adquiere,#div_trans,#div_calculos,#div_final").hide("Explode");
        $("#div_pred").show("Explode");
    }
    if(tipo==4){
        $("#div_adquiere,#div_trans,#div_final,#div_pred").hide("Explode");
        $("#div_calculos").show("Explode");
    }
        
}
function fn_cal_pred()
{
    $("#dlg_autovaluo").val(formato_numero($("#selpredios option:selected").attr("autovaluo"),2,".",","));
    
}

function validarventa()
{
    if($("#dlg_pre_trans").val()==""||$("#dlg_tip_cam").val()==""){$("#dlg_val_tot_soles").val(0);return false;}
    $("#dlg_val_tot_soles").val(formato_numero(($("#dlg_pre_trans").val()*$("#dlg_tip_cam").val()),2,".",","));
    if(parseFloat($("#dlg_autovaluo_aplicado").val().replace(",",""))>parseFloat($("#dlg_val_tot_soles").val().replace(",","")))
    {
        $("#dlg_bi_apli").val($("#dlg_autovaluo_aplicado").val());
    }
    else
    {
        $("#dlg_bi_apli").val($("#dlg_val_tot_soles").val());
    }
    $("#dlg_bi_afecta").val(formato_numero((parseFloat($("#dlg_bi_apli").val().replace(",",""))-parseFloat($("#dlg_tot_deduc").val().replace(",",""))),2,".",","));
    $("#dlg_tot_pago").val(formato_numero((parseFloat($("#dlg_bi_afecta").val().replace(",",""))*parseFloat($("#dlg_tasa_imp").val().replace(",",""))/100),2,".",","));
}

function fn_confirmar()
{
    $.SmartMessageBox({
            title : "Confirmación Final!",
            content : "Está por generar impuesto de Alcabala para este Contribuyente, desea Grabar la información",
            buttons : '[Cancelar][Aceptar]'
    }, function(ButtonPressed) {
            if (ButtonPressed === "Aceptar") {

                    fn_save_alcab();
            }
            if (ButtonPressed === "Cancelar") {
                    $.smallBox({
                            title : "No se Guardo",
                            content : "<i class='fa fa-clock-o'></i> <i>Puede Corregir...</i>",
                            color : "#C46A69",
                            iconSmall : "fa fa-times fa-2x fadeInRight animated",
                            timeout : 3000
                    });
            }

    });
}
function fn_save_alcab()
{
    MensajeDialogLoadAjax('dlg_new_alcabala', '.:: CARGANDO ...');
   $.ajax({url: 'alcabala/create',
        type: 'GET',
        data:{pred:$("#selpredios").val(),adqui:$("#dlg_adquire_hidden").val(),adqui_rl:$("#dlg_adquire_rep").val(),
              trans:$("#dlg_trans_hidden").val(),trans_rl:$("#dlg_trans_rep").val(),
          contra:$("#selcontrato").val(),doctrans:$("#selcontrato").val(),fectrans:$("#dlg_fec_trans").val(),
            notaria:$("#dlg_notaria").val(),bimpo:$("#dlg_autovaluo").val().replace(",",""),
            vtrans:$("#dlg_val_tot_soles").val().replace(",",""),poradq:$("#dlg_por_aplicado").val().replace(",",""),
        bafecta:$("#dlg_fin_afecta").val().replace(",",""),imp_tot:$("#dlg_fin_pagar").val().replace(",",""),tip_camb:$("#dlg_tip_cam").val().replace(",",""),
     inafec:$("#selinafec").val()},
        success: function(r) 
        {
            //window.open('fis_rep/'+tip+'/'+r+'/'+sec+'/'+man);
            MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
            MensajeDialogLoadAjaxFinish("dlg_new_alcabala");
            $("#dlg_new_alcabala").dialog("close");
            fn_bus_ani()
        },
        error: function(data) {
            MensajeAlerta("hubo un error, Comunicar al Administrador","",4000);
            MensajeDialogLoadAjaxFinish("dlg_new_alcabala");
            console.log('error');
            console.log(data);
        }
        });
}