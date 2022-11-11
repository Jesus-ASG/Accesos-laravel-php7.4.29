<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acceso extends Model
{
    public $timestamps = false;
    use HasFactory;

    //Relación uno a muchos inversa
    public function estudiante(){
        //Modelo, llave foránea (a la cual se hace referencia), llave primaria
        return $this->belongsTo(Estudiante::class);
    }

}
