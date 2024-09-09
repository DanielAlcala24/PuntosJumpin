<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use DB;
use date;
use App\Models\Puntos;
use App\Models\Empleados;
use App\Models\Departamentos;
use App\Models\Actividades;
use App\Models\Regalos;
use App\Models\Canjes;

use Illuminate\Support\Str;

class UsuariosController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
      $users = DB::table('tb_usuario')
            ->join('tb_cargo', 'tb_usuario.id_cargo', '=', 'tb_cargo.id')
            ->select('users.*', 'tb_cargo.cargo')
            ->get();
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       $lista = DB::table('tb_usuario')
            ->where('sts_usuario','<>','EL')
            ->where('nombre_usuario','LIKE','%'.$request->nombre_usuario.'%')
            ->join('tb_cargo', 'tb_usuario.id_cargo', '=', 'tb_cargo.id')
            ->select('tb_usuario.*', 'tb_cargo.cargo')
            ->orderBy('tb_usuario.id')
            ->Paginate(10)->appends($request->except(['page','_token']));

       return view('usuarios.lista_usuarios',['listausers'=>$lista,'databusqueda'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        if ($request->id_usuario!='') {
            $dtUsuario=User::find($request->id_usuario);
            $dtUsuario->nombre_usuario=$request->nombre_usuario;
            if ($request->clave!='') {
              $dtUsuario->password=Hash::make($request->clave);
            }
            
            $dtUsuario->save();  
        }else{
            $dtUsuario=new User();
            $dtUsuario->id_cargo=1;
            $dtUsuario->nombre_usuario=$request->nombre_usuario;
            $dtUsuario->email=$request->email;
            $dtUsuario->password=Hash::make($request->clave);
            $dtUsuario->save();            
        }

        return redirect()->route('listar.usuarios');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $dtUsuario=User::find($request->id_usuario);
        $dtUsuario->delete(); 
        return redirect()->route('listar.usuarios');
    }


    public function puntos(Request $request)
    {
       $lista = DB::table('tb_puntos')
            ->where('tb_empleado.nombre','LIKE','%'.$request->nombre_usuario.'%')
            ->orwhere('tb_empleado.num_docu','LIKE','%'.$request->nombre_usuario.'%')
            ->join('tb_empleado', 'tb_puntos.id_empleado', '=', 'tb_empleado.id')
            ->select('tb_puntos.*','tb_empleado.nombre','tb_empleado.num_docu')
            ->orderBy('tb_puntos.id','DESC')
            ->Paginate(10)->appends($request->except(['page','_token']));
       return view('puntos',['listadatos'=>$lista,'databusqueda'=>$request]);
    }


  
    public function saveproy(Request $request)
    {
        $dt_ac=Actividades::find($request->actividad);
        if ($request->id_proy!='') {
            $dt=Puntos::find($request->id_proy);
            $dt->id_empleado =$request->empleado;
            $dt->id_actividad=$request->actividad;
            $dt->puntos=$dt_ac->puntos;
            $dt->save();  
        }else{
            
            $dt=new Puntos();
            $dt->id_empleado =$request->empleado;
            $dt->id_actividad=$request->actividad;
            $dt->puntos=$dt_ac->puntos;
            $dt->save();            
        }
        return redirect()->route('listar.puntos');
    }




    public function personas(Request $request)
    {
       $lista = DB::table('tb_empleado')
            ->where('nombre','LIKE','%'.$request->nombre_usuario.'%')
            ->orwhere('num_docu','LIKE','%'.$request->nombre_usuario.'%')
            ->orwhere('telefono','LIKE','%'.$request->nombre_usuario.'%')
            ->select('tb_empleado.*')
            ->orderBy('tb_empleado.id')
            ->Paginate(10)->appends($request->except(['page','_token']));

       return view('personas',['listadatos'=>$lista,'databusqueda'=>$request]);
    }

    public function guardarPersona(Request $request)
    {
        
            $id_persona=$request->id_persona;
            if ($request->tipo_docu!='') { $txt_tipo=$request->tipo_docu; }else{ $txt_tipo=''; }
            if ($request->num_docu!='') { $txt_num=$request->num_docu; }else{ $txt_num=''; }
            if ($request->correo_persona!='') { $txt_correo=$request->correo_persona; }else{ $txt_correo=''; }
            if ($request->telefono_persona!='') { $txt_telf=$request->telefono_persona; }else{ $txt_telf=''; }

            $dato=''; 
            if ($id_persona=='') {
                    $dtPersona=new Empleados();
                    $dtPersona->tipo_docu=$txt_tipo;
                    $dtPersona->num_docu=$txt_num;
                    $dtPersona->nombre=mb_strtoupper($request->nom_persona);
                    $dtPersona->correo=$txt_correo;
                    $dtPersona->telefono=$txt_telf;
                    $dtPersona->id_departamento=$request->id_departamento;
                    $dtPersona->save();
                    $dato=$dtPersona->id; 

                    $dtUsuario=new User();
                    $dtUsuario->id_cargo=2;
                    $dtUsuario->id_emple=$dato;
                    $dtUsuario->nombre_usuario=mb_strtoupper($request->nom_persona);
                    $dtUsuario->email=$txt_correo;
                    $dtUsuario->password=Hash::make($txt_num);
                    $dtUsuario->save(); 


            }else{
                    $dtPersona=Empleados::find($id_persona);
                    $dtPersona->tipo_docu=$txt_tipo;
                    $dtPersona->num_docu=$txt_num;
                    $dtPersona->nombre=mb_strtoupper($request->nom_persona);
                    $dtPersona->correo=$txt_correo;
                    $dtPersona->telefono=$txt_telf;
                    $dtPersona->id_departamento=$request->id_departamento;
                    $dtPersona->save();
                    $dato=$dtPersona->id; 

                    User::where('id_emple',$dato)->update(['nombre_usuario'=>mb_strtoupper($request->nom_persona),'email'=>$txt_correo]);


            }
            return redirect()->route('listapersonas');
    }


    public function estaciones(Request $request)
    {
       $lista = DB::table('tb_departamento')
            ->where('nombre','LIKE','%'.$request->nombre_usuario.'%')
            ->orderBy('tb_departamento.id','DESC')
            ->Paginate(10)->appends($request->except(['page','_token']));

       return view('estaciones',['listadatos'=>$lista,'databusqueda'=>$request]);
    }


    public function estacion(Request $request)
    {
            if ($request->id_proy=='') {
                $dt=new Departamentos();
                $dt->id_responsable=$request->id_responsable;
                $dt->nombre=$request->nombre;
                $dt->save();                  
            }else{
                $dt=Departamentos::find($request->id_proy);
                $dt->id_responsable=$request->id_responsable;
                $dt->nombre=$request->nombre;
                $dt->save(); 
            }
            return redirect()->route('listar.estaciones');
    }


    public function actividades(Request $request)
    {
       $lista = DB::table('tb_actividad')
            ->where('actividad','LIKE','%'.$request->nombre_usuario.'%')
            ->orwhere('puntos',$request->nombre_usuario)
            ->select('tb_actividad.*')
            ->orderBy('tb_actividad.id')
            ->Paginate(10)->appends($request->except(['page','_token']));

       return view('actividades',['listadatos'=>$lista,'databusqueda'=>$request]);
    }

    public function actividad(Request $request)
    {
            if ($request->id_proy=='') {
                $dt=new Actividades();
                $dt->actividad=$request->nombre;
                $dt->puntos=$request->puntos;
                $dt->save();                  
            }else{
                $dt=Actividades::find($request->id_proy);
                $dt->actividad=$request->nombre;
                $dt->puntos=$request->puntos;
                $dt->save(); 
            }
            return redirect()->route('listar.actividades');
    }

    public function list_regalos(Request $request)
    {
       $lista = DB::table('tb_regalos')
            ->where('nombre','LIKE','%'.$request->nombre_usuario.'%')
            ->orwhere('puntos',$request->nombre_usuario)
            ->select('tb_regalos.*')
            ->orderBy('tb_regalos.id','DESC')
            ->Paginate(10)->appends($request->except(['page','_token']));

       return view('regalos',['listadatos'=>$lista,'databusqueda'=>$request]);
    }

    public function regalo(Request $request)
    {
        
        $txtadjunto='';
        if ($request->file('foto')) {
            $archivo=$request->file('foto');
            $txtadjunto='reg_'.Str::random(10).'.png';
            $path=public_path().'/regalos';
            $archivo->move($path,$txtadjunto);
        }

        if ($request->id_proy=='') {
            $dt=new Regalos();
            $dt->nombre=$request->nombre;
            $dt->foto=$txtadjunto;
            $dt->puntos=$request->puntos;
            $dt->save();                  
        }else{
            $dt=Regalos::find($request->id_proy);
            $dt->nombre=$request->nombre;
            if ($request->file('foto')) {
              $dt->foto=$txtadjunto;
            }
            $dt->puntos=$request->puntos;
            $dt->save(); 
        }
        return redirect()->route('listar.regalos');
    }



    public function list_canjes(Request $request)
    {
       //
       $lista = DB::table('tb_canjes')
            ->where('tb_empleado.num_docu','LIKE','%'.$request->nombre_usuario.'%')
            ->orwhere('tb_empleado.nombre','LIKE','%'.$request->nombre_usuario.'%')
            ->join('tb_empleado', 'tb_canjes.id_empleado', '=', 'tb_empleado.id')
            ->join('tb_regalos', 'tb_canjes.id_regalo', '=', 'tb_regalos.id')
            ->select('tb_canjes.*','tb_empleado.num_docu','tb_empleado.nombre as nom_empleado','tb_empleado.nombre as nom_regalo','tb_regalos.foto','tb_regalos.nombre')
            ->orderBy('tb_canjes.id','DESC')
            ->Paginate(10)->appends($request->except(['page','_token']));

       return view('canjes',['listadatos'=>$lista,'databusqueda'=>$request]);
    }


    public function canje(Request $request)
    {
        
        if ($request->id_proy=='') {
            $dt=new Canjes();
            $dt->id_empleado=$request->empleado;
            $dt->id_regalo=$request->regalo;
            $dt_punt=Regalos::find($request->regalo);
            $dt->puntos=$dt_punt->puntos;
            $dt->save();                  
        }else{
            $dt=Canjes::find($request->id_proy);
            $dt->id_empleado=$request->empleado;
            $dt->id_regalo=$request->regalo;
            $dt_punt=Regalos::find($request->regalo);
            $dt->puntos=$dt_punt->puntos;
            $dt->save(); 
        }
        return redirect()->route('listar.canjes');
    }



    public function canjear(Request $request)
    {
            $dt=new Canjes();
            $dt->id_empleado=$request->id_emple;
            $dt->id_regalo=$request->id_regalo;
            $dt_punt=Regalos::find($request->id_regalo);
            $dt->puntos=$dt_punt->puntos;
            $dt->save();                  
     
        return redirect()->route('listar.canjes');
    }




    public function ajaxRegalos(Request $request)
    {
      if ($request->ajax()) {
            $id_empleado=$request->get('id_empleado');
            $lista='';

          $dt_suma=Puntos::where('id_empleado',$id_empleado)->sum('puntos');
          $dt_resta=Canjes::where('id_empleado',$id_empleado)->sum('puntos');
          $mis_puntos=$dt_suma - $dt_resta;

          $dt_regalos=Regalos::where('puntos','<=',$mis_puntos)->get();

          if ($dt_regalos->count()>0) {
            foreach ($dt_regalos as $regalo) {
               $lista.='<option value="'.$regalo->id.'">'.mb_strtoupper($regalo->nombre).' - '.$regalo->puntos.' puntos </option>';
            }
          }

            $data=array('regalos' => $lista);  
            echo json_encode($data);
        }
    }


    public function ajax_prueba(Request $request)
    {
          $dt_suma=Puntos::where('id_empleado',9)->sum('puntos');
          $dt_resta=Canjes::where('id_empleado',9)->sum('puntos');
          $mis_puntos=$dt_suma - $dt_resta;
          return $mis_puntos;
    }

    public function delestacion($id)
    {
      $dt=Departamentos::find($id);
      $dt->delete(); 
      return redirect()->route('listar.estaciones');
    }

    public function delempleado($id)
    {
      $dt=Empleados::find($id);
      $dt->delete(); 
      return redirect()->route('listapersonas');
    }


    public function delactiv($id)
    {
      $dt=Actividades::find($id);
      $dt->delete(); 
      return redirect()->route('listar.actividades');
    }

    public function delregalo($id)
    {
      $dt=Regalos::find($id);
      $dt->delete(); 
      return redirect()->route('listar.regalos');
    }

    public function delcanje($id)
    {
      $dt=Canjes::find($id);
      $dt->delete(); 
      return redirect()->route('listar.canjes');
    }


}

