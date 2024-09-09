<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regalos extends Model
{
    use HasFactory;
    protected $table='tb_regalos';// tabla
    public $timestamps=true;
    protected $fillable=['nombre','foto','puntos']; // campos
    protected $guarded=['id'];
    protected $hidden=['created_at','updated_at'];

}
