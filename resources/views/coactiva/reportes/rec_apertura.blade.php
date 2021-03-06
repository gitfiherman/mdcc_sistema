<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>REC</title>
        <style>        
            @font-face {
                font-family: SourceSansPro;
                src: url(SourceSansPro-Regular.ttf);
            }
            @page {                
                margin: 180px 75px;
            }
            #header { position: fixed; left: 0px; top: -180px; right: 0px; height: 100px; text-align: center; }
/*            #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 100px; background-color: lightblue; }
            #footer .page:after { content: counter(page, upper-roman); }*/
            .t1, .t2 { border-collapse: collapse; }
            .t1 > tbody > tr > td { border: 1px solid #D5D5D5; font-size: 13px}
            .t1 > thead > tr > th { border:1px solid #D5D5D5; background: #01A858;color: white; }
        </style>

    </head>    
    <body>
        <div id="header" style="padding-top:20px">            
            <img src="img/escudo.png" style="position:absolute;margin-top: 25px;margin-left: -10px; width: 55px;height: 65px;" >
            <center>
                <h3 style="color:#018F4B;margin-bottom:0px;font-size: 20px;">MUNICIPALIDAD DISTRITAL DE CERRO COLORADO</h3>
                <p style="margin-top:7px;font-size: 12px;"><b>Dirección:</b> Mariano Melgar N° 500, Urb. La Libertad, Cerro Colorado - Arequipa</p>
                <H3 style="margin-top:0px;font-size: 13px;"><b>OFICINA DE EJECUCIÓN COACTIVA / TELF: 54-382590 ANEXO: 733</b> </H3>                
                <div style="background:#01A858; margin-top: 0px;height: 1px"></div>           
            </center> 
        </div>
        <div style="margin-top: -40px;">
            <table style="font-size:15px;">
                <tr>
                    <td><b>Expediente N°</b></td>
                    <td>:&nbsp;{{ $resol->nro_exped.'-'.$resol->anio_resol }} / OEC-MDCC<br/></td>
                </tr>
                <tr>
                    <td><b>Entidad</b></td>
                    <td>:&nbsp;MUNICIPALIDAD DISTRITAL DE CERRO COLORADO<br/></td>
                </tr>
                <tr>
                    <td><b>Obligado</b></td>
                    <td>:&nbsp;{{$resol->contribuyente}}<br/></td>
                </tr>
                <tr>
                    <td><b>Materia</b></td>
                    <td>:&nbsp;{{$resol->desc_mat}}<br/></td>
                </tr>
                <tr>
                    <td><b>Domicilio</b></td>
                    <td>:&nbsp;{{$resol->dom_fis}}<br/></td>
                </tr>
                <tr>
                    <td><b>Ubicacion de Predio</b></td>
                    <td>:&nbsp;{{$resol->ubi_pred}}<br/></td>
                </tr>
            </table>
            </div>
        <br>
        <div style="text-align:center"><b>RESOLUCIÓN DE EJECUCIÓN COACTIVA NRO. {{ $resol->nro_resol.'-'.$resol->anio_resol }} / OEC-MDCC</b></div><br>
        
        <div style="text-align: justify;font-size:15px;overflow:auto">           
            @php echo $plantilla @endphp
        </div>     
    </body>
</html>
