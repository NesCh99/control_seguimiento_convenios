<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resolucion extends Model
{
    use HasFactory;
    protected $table = 'v_resoluciones';//reconoce el nombre de la tabla
    protected $primaryKey = 'idResolucion';//reconoce el nombre del PK
    const CREATED_AT = 'tstCreacionResolucion'; // personaliza el campo created_at
    const UPDATED_AT = 'tstModificacionResolucion'; // personaliza el campo updated_at

    protected $fillable = ['chaNombreResolucion',                        
                        'sinTipoResolucion',
                        'tstCreacionResolucion',
                        'tstModificacionResolucion'];


    //Relacion uno a muchos
    public function Convenios(){
        return $this->hasMany(Convenio::class,'idResolucion');
    }
    //Relacion muchos a muchos 
    public function Coordinadores(){
        return $this->belongsToMany(Coordinador::class, 'v_coordinadores_resoluciones' ,'idResolucion', 'idCoordinador');
    }

    
}
