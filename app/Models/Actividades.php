<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividades extends Model
{
    use HasFactory;
    protected $table='tb_actividad';
    public $timestamps=true;
    protected $fillable=['actividad','puntos']; 
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];

}
