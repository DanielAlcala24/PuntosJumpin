<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleados extends Model
{
    use HasFactory;
    protected $table='tb_empleado';// tabla
    public $timestamps=true;
    protected $fillable=['tipo_docu','num_docu','nombre','correo','telefono','id_departamento']; // campos
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];

}
