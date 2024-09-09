<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cargos extends Model
{
    use HasFactory;
    protected $table='tb_cargo';// tabla
    public $timestamps=true;

    protected $fillable=['cargo']; // campos

    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];

    public function saludar($mensaje)
    {
    	return $mensaje;
    }
}
