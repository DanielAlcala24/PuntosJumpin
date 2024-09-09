<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DateTime;

use App\Models\Actividades;
use App\Models\Empleados;
use App\Models\Departamentos;
use App\Models\Puntos;
use App\Models\Canjes;

use Excel;

class FuncionesController extends Controller
{
    //
    public function Cargo_Usuario($id_cargo)
    {
    	// buscar cargo por el id
    	$row_cargo=DB::table('tb_cargo')->where('id',$id_cargo)->first();
    	// obtener nombre del cargo
    	return $row_cargo->cargo;
    }


    public function usuarios()
    {
        // buscar cargo por el id
        $dt=DB::table('tb_usuario')->get();
        return $dt;
    }


    public function nomEmpleado($id)
    {
        $datoi=Empleados::find($id);
        $dato=mb_strtoupper($datoi->nombre);
        return $dato;
    }

    public function nom_actividad($id)
    {
        $datoi=Actividades::find($id);
        $dato=mb_strtoupper($datoi->actividad);
        return $dato;
    }

    public function cmb_departamentos()
    {
        $cmb_estacion=''; 
        $datos=Departamentos::orderBy('nombre','ASC')->get();
        foreach ($datos as $dato) {
            $cmb_estacion.='<option value="'.$dato->id.'">'.mb_strtoupper($dato->nombre).'</option>';
        }
        return $cmb_estacion;
    }

    public function cmb_empleados()
    {
        $cmb=''; 
        $datos=Empleados::orderBy('nombre','ASC')->get();
        foreach ($datos as $dato) {
            $cmb.='<option value="'.$dato->id.'">'.$dato->num_docu.' - '.mb_strtoupper($dato->nombre).'</option>';
        }
        return $cmb;
    }

    public function cmb_empleados_canje()
    {
        $cmb=''; 
        $datos=Empleados::orderBy('nombre','ASC')->get();
        foreach ($datos as $dato) {
            $total=$this->puntos_disponibles($dato->id);
            $cmb.='<option value="'.$dato->id.'">'.$dato->num_docu.' - '.mb_strtoupper($dato->nombre).' - '.$total.' puntos'.'</option>';
        }
        return $cmb;
    }



    public function puntos_disponibles($id_empleado)
    {
        $mis_puntos=0; 
        $dt_suma=Puntos::where('id_empleado',$id_empleado)->sum('puntos');
        $dt_resta=Canjes::where('id_empleado',$id_empleado)->sum('puntos');
        $mis_puntos=$dt_suma - $dt_resta;
        return $mis_puntos;
    }



    public function puntos_acum($id_empleado)
    {
        $mis_puntos=0; 
        $dt_suma=Puntos::where('id_empleado',$id_empleado)->sum('puntos');

        $mis_puntos=$dt_suma;
        return $mis_puntos;
    }

        public function puntos_canje($id_empleado)
    {
        $mis_puntos=0; 
        $dt_resta=Canjes::where('id_empleado',$id_empleado)->sum('puntos');

        $mis_puntos=$dt_resta;
        return $mis_puntos;
    }



    public function cmb_actividades()
    {
        $cmb=''; 
        $datos=Actividades::orderBy('actividad','ASC')->get();
        foreach ($datos as $dato) {
            $cmb.='<option value="'.$dato->id.'">'.mb_strtoupper($dato->actividad).' - '.$dato->puntos.' puntos </option>';
        }
        return $cmb;
    }


    public function cmb_regalos_posibles($id_empleado)
    {
        $cmb=''; 
        $puntos=$this->puntos_disponibles($id_empleado);

         $dt_regalos=Regalos::where('Puntos','<=',$puntos)->get();
          foreach ($dt_regalos as $regalo) {
             $lista.='<option value="'.$regalo->id.'">'.mb_strtoupper($regalo->nombre).' - '.$regalo->puntos.' puntos </option>';
          }

        return $cmb;
    }


    public function nom_depart($id)
    {
        $nom_estacion=''; 
        $dato=Departamentos::find($id);
        $nom_estacion=mb_strtoupper($dato->nombre);
        return $nom_estacion;
    }


    public function estacion_rpt($id)
    {
        $dato=Estaciones::find($id);
        return $dato;
    }


}

