<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puntos extends Model
{
    use HasFactory;
    protected $table='tb_puntos';// tabla
    public $timestamps=true;
    protected $fillable=['id_empleado','id_actividad','puntos']; // campos
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];

}
