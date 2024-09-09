<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    use HasFactory;
    protected $table='tb_departamento';
    public $timestamps=true;
    protected $fillable=['id_responsable','nombre']; 
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];

}

