<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canjes extends Model
{
    use HasFactory;
    protected $table='tb_canjes';// tabla
    public $timestamps=true;
    protected $fillable=['id_empleado','id_regalo','puntos']; // campos
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];

}
