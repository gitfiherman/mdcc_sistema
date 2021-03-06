<?php

namespace App\Http\Controllers\archivo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\DatesTranslator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Models\archivo\digitalizacion;

class DigitalizacionController extends Controller
{
    use DatesTranslator;
    public function index()
    {
        $permisos = DB::select("SELECT * from permisos.vw_permisos where id_sistema='li_arch_reg_exp' and id_usu=".Auth::user()->id);
        $menu = DB::select('SELECT * from permisos.vw_permisos where id_usu='.Auth::user()->id);
        if(count($permisos)==0)
        {
            return view('errors/sin_permiso',compact('menu','permisos'));
        }
        $tip_doc = DB::connection('digitalizacion')->select("select * from tip_doc");
        return view('archivo/vw_digitalizacion', compact('menu','permisos','tip_doc'));
    }

    public function create(Request $request)
    {
        //declar_inscripcion;
        $file = $request->file('dlg_documento_file');
        
        if($file)
        {
            $file2 = \File::get($file);
            $dig=new digitalizacion;
            $dig->id_contribuyente=$request['id_contrib_hidden'];
            $dig->id_tip_doc=$request['seltipdoc'];
            $dig->anio=$request['dlg_anio'];
            $dig->fecha=$request['dlg_fec'];
            $dig->observacion=$request['dlg_obs_exp'];
            $dig->direccion=strtoupper($request['dlg_direcc_hiddn']);
            $dig->id_usuario = Auth::user()->id;
            $dig->save();
            $tipo_schema = DB::connection('digitalizacion')->select("select * from tip_doc where id_tip=".$request['seltipdoc']);
            if(count($tipo_schema)>=1)
            {
                DB::connection('digitalizacion')->table(trim($tipo_schema[0]->schem).".".trim($tipo_schema[0]->abrev).$dig->anio)->insert([
                    ['doc_b64' => base64_encode($file2), 'id' => $dig->id,'id_usuario'=>Auth::user()->id]
                ]);
            }
            return $dig->id;
        }
        else
        {
            return 0;
        }
    }

    public function store(Request $request)
    {
    }

 
    public function show($id)
    {
        $archi= DB::connection('digitalizacion')->table('vw_digital')->where('id',$id)->get();
        $archi[0]->fecha=trim($this->getCreatedAtAttribute($archi[0]->fecha)->format('d/m/Y'));
        return $archi;
    }

    public function edit(Request $request)
    {
        $dig=new digitalizacion;
        $val=  $dig::where("id","=",$request['id_arch'] )->first();
        if(count($val)>=1)
        {
            if($val->id_tip_doc!=$request['seltipdoc']||$val->anio!=$request['dlg_anio'])
            {
                $sql = DB::connection('digitalizacion')->select('select * from vw_digital where id='.$val->id);
                $pdf = DB::connection('digitalizacion')->table(trim($sql[0]->schem).".".trim($sql[0]->abrev).$sql[0]->anio)->where('id',$val->id)->get();
                $tipo_schema = DB::connection('digitalizacion')->select("select * from tip_doc where id_tip=".$request['seltipdoc']);
                DB::connection('digitalizacion')->table(trim($tipo_schema[0]->schem).".".trim($tipo_schema[0]->abrev).$request['dlg_anio'])->insert([
                    ['doc_b64' => $pdf[0]->doc_b64, 'id' => $val->id,'id_usuario'=>Auth::user()->id]
                ]);
                DB::connection('digitalizacion')->table(trim($sql[0]->schem).".".trim($sql[0]->abrev).$sql[0]->anio)->where('id',$val->id)->delete();
                $val->id_tip_doc=$request['seltipdoc'];
                $val->anio=$request['dlg_anio'];
            }
            $val->fecha=$request['dlg_fec'];
            $val->observacion=$request['dlg_obs_exp'];
            $val->direccion=strtoupper($request['dlg_direcc_hiddn']);
            $val->save();
        }
        return $val->id;
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
     function grid_expe(Request $request){
         if($request['contrib']==0)
         {
             return 0;
         }
         else
         {
            $page = $_GET['page'];
            $limit = $_GET['rows'];
            $sidx = $_GET['sidx'];
            $sord = $_GET['sord'];
            $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
            if ($start < 0) {
                $start = 0;
            }
            
            $totalg = DB::connection('digitalizacion')->select("select count(id) as total from vw_digital where id_contribuyente=".$request['contrib']);
            $sql = DB::connection('digitalizacion')->table('vw_digital')->where('id_contribuyente',$request['contrib'])->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
            

            $total_pages = 0;
            if (!$sidx) {
                $sidx = 1;
            }
            $count = $totalg[0]->total;
            if ($count > 0) {
                $total_pages = ceil($count / $limit);
            }
            if ($page > $total_pages) {
                $page = $total_pages;
            }

            $Lista = new \stdClass();
            $Lista->page = $page;
            $Lista->total = $total_pages;
            $Lista->records = $count;

            foreach ($sql as $Index => $Datos) {
                $Lista->rows[$Index]['id'] = $Datos->id;            
                $Lista->rows[$Index]['cell'] = array(
                    trim($Datos->id),
                    trim($Datos->anio),
                    trim($Datos->documento),
                    trim($this->getCreatedAtAttribute($Datos->fecha)->format('d/m/Y')),
                    trim($Datos->observacion),
                    '<button class="btn btn-labeled btn-warning" type="button" onclick="verfile('.trim($Datos->id).')"><span class="btn-label"><i class="fa fa-file-text-o"></i></span> Ver</button>',
                );
            }
            return response()->json($Lista);
        }
     }
     
    function get_pdf()
    {   
           $file = file_get_contents($_FILES['dlg_documento_file']['tmp_name']);
            if($_FILES["dlg_documento_file"]["type"]=='application/pdf')
            {  
                return Response::make($file, 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="prueba"'
                ]);
            }
            else
            {    return "<html><head></head><body style='margin:3px;padding:0px;font-family:verdana;font-size:11px'>No es .pdf</body></html>";$i=0;}
    }
    public function verfile($id)
    {
        $sql = DB::connection('digitalizacion')->select('select * from vw_digital where id='.$id);
        if(count($sql)>=1)
        {
            $pdf = DB::connection('digitalizacion')->table(trim($sql[0]->schem).".".trim($sql[0]->abrev).$sql[0]->anio)->where('id',$id)->get();
            return Response::make(base64_decode($pdf[0]->doc_b64), 200, [
                    'Content-Type' => 'application/pdf',
                    'Content-Disposition' => 'inline; filename="prueba"'
                ]);
        }
        else
        {
            return "No hay Archvos";
        }
    }
    public function get_cotrib_byname(Request $request) {
        if($request['dat']=='0')
        {
            return 0;
        }
        else
        {
        header('Content-type: application/json');
        $totalg = DB::connection('digitalizacion')->select("select count(id_contrib) as total from vw_contribuyentes where nombres like '%".strtoupper($request['dat'])."%'");
        $page = $_GET['page'];
        $limit = $_GET['rows'];
        $sidx = $_GET['sidx'];
        $sord = $_GET['sord'];

        $total_pages = 0;
        if (!$sidx) {
            $sidx = 1;
        }
        $count = $totalg[0]->total;
        if ($count > 0) {
            $total_pages = ceil($count / $limit);
        }
        if ($page > $total_pages) {
            $page = $total_pages;
        }
        $start = ($limit * $page) - $limit; // do not put $limit*($page - 1)  
        if ($start < 0) {
            $start = 0;
        }

        $sql = DB::connection('digitalizacion')->table('vw_contribuyentes')->where('nombres','like', '%'.strtoupper($request['dat']).'%')->orderBy($sidx, $sord)->limit($limit)->offset($start)->get();
        $Lista = new \stdClass();
        $Lista->page = $page;
        $Lista->total = $total_pages;
        $Lista->records = $count;
        
        
        foreach ($sql as $Index => $Datos) {
            $Lista->rows[$Index]['id'] = $Datos->id_contrib;            
            $Lista->rows[$Index]['cell'] = array(
                trim($Datos->id_contrib),
                trim($Datos->nro_documento),
                trim(str_replace("-", "",$Datos->nombres)),
                trim($Datos->domicilio),
                trim($Datos->nro_expediente),
            );
        }
        return response()->json($Lista);
        }
    }
    public function validar(Request $request)
    {
        $direcs = explode("; ", $request['dir']);
        $lista="";
        foreach($direcs as $dirs)
        {
            $count = DB::connection('digitalizacion')->select("select * from vw_digital where direccion like '%".strtoupper($dirs)."%' and id_contribuyente <> ".$request['contri']);
            if(count($count)>0)
            {   
                $lista=$lista."La Direccion -".$dirs."- ya fue registrada en los siguientes Contribuyentes:<br>";
                $poseedores = DB::connection('digitalizacion')->select("select nombres from vw_digital where direccion like '%".strtoupper($dirs)."%' and id_contribuyente <> ".$request['contri']." group by nombres");
                foreach($poseedores as $contri)
                {
                    $lista=$lista."---".$contri->nombres."<br>";
                }
            }
        }
        return $lista;
    }
}
