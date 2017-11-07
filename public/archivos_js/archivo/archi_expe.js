function fn_bus_contrib_arch(input)
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
    jQuery("#table_contrib").jqGrid('setGridParam', {url: 'grid_contrib_arch?dat='+$("#"+input).val()}).trigger('reloadGrid');

    $("#dlg_bus_contr").dialog({
        autoOpen: false, modal: true, width:770, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  Busqueda de Contribuyente :.</h4></div>"       
        }).dialog('open');
}
function fn_bus_contrib_list_arch(per)
{
    $("#id_contrib_hidden").val(per);
    $("#dlg_contrib").val($('#table_contrib').jqGrid('getCell',per,'contribuyente'));
    $("#dlg_nro_doc").val($('#table_contrib').jqGrid('getCell',per,'nro_doc'));
    $("#dlg_domicilio").val($('#table_contrib').jqGrid('getCell',per,'dom_fiscal'));
    $("#dlg_num_exp").val($('#table_contrib').jqGrid('getCell',per,'nro_expediente'));
    jQuery("#table_doc").jqGrid('setGridParam', {url: 'list_arch_expe?contrib='+per}).trigger('reloadGrid');
    $("#dlg_bus_contr").dialog("close");
}
function fn_new_archi_expe()
{
    if($("#id_contrib_hidden").val()==0)
    {
        mostraralertasconfoco("Seleccione Contribuyente","#dlg_nro_doc");
        return false;
    }
   limpiar_new();
    $("#dlg_new_expe").dialog({
        autoOpen: false, modal: true, width: 1300, 
        show:{ effect: "explode", duration: 500},
        hide:{ effect: "explode", duration: 800}, resizable: false,
        title: "<div class='widget-header'><h4><span class='widget-icon'> <i class='fa fa-align-justify'></i> </span> Nuevo Documento</h4></div>",
        buttons: [
            {
                id:"btnsave",
                html: '<span class="btn-label"><i class="glyphicon glyphicon-new-window"></i></span>Grabar Documento',
                "class": "btn btn-labeled bg-color-green txt-color-white",
                click: function () {saveexpe();}
            },

            {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-primary bg-color-red",
                click: function () {$(this).dialog("close");}
            }]
        }).dialog('open');
 
}
function limpiar_new()
{
    $('#ifrafile').attr('src', '');
    $("#seltipdoc").val(1);
    $("#dlg_anio,#dlg_fec,#dlg_direcc,#dlg_documento_file,#dlg_obs_exp").val("");
    
}
function limpiar_arch_expe()
{
     $("#table_doc").jqGrid("clearGridData", true);
    $("#id_contrib_hidden").val(0);
    $("#dlg_nro_doc,#dlg_contrib,#dlg_domicilio,#dlg_num_exp").val("");
    
}


function saveexpe()
{

    if($("#seltipdoc").val()==0||$("#seltipdoc").val()=="")
    {
        mostraralertasconfoco("seleccione tipo de Documento","#seltipdoc");
        return false;
    }
    
    if($("#dlg_anio").val()<1980||$("#dlg_anio").val()=="")
    {
        mostraralertasconfoco("Ingresar Año correctamente","#dlg_anio");
        return false;
    }
    if($("#dlg_fec").val()=="")
    {
        mostraralertasconfoco("Ingresar Fecha","#dlg_fec");
        return false;
    }
    
    MensajeDialogLoadAjax('dlg_new_expe', '.:: CARGANDO ...');
    var form= new FormData($("#FormularioFiles")[0]);
        $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'create_exp',
        type: 'POST',  
        dataType: 'json',
        data: form,
        processData: false,
        contentType: false,
        success: function(r) 
        {
            if(r==0)
            {
                mostraralertasconfoco("Subir Archivo de lo contrario no se podra Grabar","#dlg_documento_file");
            }
            else
            {
                MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
                busqueda(1);
                $("#dlg_new_expe").dialog("close");
            }
            MensajeDialogLoadAjaxFinish('dlg_new_expe');
            
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            MensajeDialogLoadAjaxFinish('dlg_new_expe');
            console.log('error');
            console.log(data);
        }
        });
}

function busqueda(tip)
{
    
    if(tip==1)
    {
        if($('#dlg_nro_doc').val()=="")
        {
            mostraralertas("Ingresar Numero de Documento...");
            return false;
        }
        num=$('#dlg_nro_doc').val();
        exp=0;
    }
    if(tip==2)
    {
        if($('#dlg_num_exp').val()=="")
        {
            mostraralertas("Ingresar Numero de expediente...");
            return false;
        }
        num=0;
        exp=$('#dlg_num_exp').val();
    }
    
        MensajeDialogLoadAjax('widget-grid', '.:: Cargando ...');
        $.ajax({url: 'archi_contribuyentes/0',
        type: 'GET',
        data:{num:num,exp:exp},
        success: function(r) 
        {
            limpiar_arch_expe();
            if(r.length>0)
            {
                $("#id_contrib_hidden").val(r[0].id_contrib);
                $("#dlg_num_exp").val(r[0].nro_expediente);
                $("#dlg_nro_doc").val(r[0].nro_documento);
                $("#dlg_contrib").val(r[0].contribuyente);
                $("#dlg_domicilio").val(r[0].domicilio);
                jQuery("#table_doc").jqGrid('setGridParam', {url: 'list_arch_expe?contrib='+r[0].id_contrib}).trigger('reloadGrid');
            }
            else
            {
                mostraralertasconfoco("No existe Documento","#dlg_nro_doc");
            }
            MensajeDialogLoadAjaxFinish('widget-grid');
            

        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('widget-grid');
        }
        });
    
    
}

function llamarsubmit()
{
    MensajeDialogLoadAjax('dlg_new_expe', '.:: CARGANDO ...');
    $("#FormularioFiles").submit();
    $('#ifrafile').load(function(){MensajeDialogLoadAjaxFinish('dlg_new_expe');}).show();
}
function verfile(id)
{
    if($("#per_imp").val()==0)
    {
        sin_permiso();
        return false;
    }
    window.open('ver_file/'+id);
}

