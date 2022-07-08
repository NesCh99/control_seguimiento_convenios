<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clasificacion extends Model
{
    
    protected $table = 'v_clasificaciones';//reconoce el nombre de la tabla
    protected $primaryKey = 'idClasificacion';//reconoce el nombre del PK
    const CREATED_AT = 'tstCreacionClasificacion'; // personaliza el campo created_at
    const UPDATED_AT = 'tstModificacionClasificacion'; // personaliza el campo updated_at
    use HasFactory;
    protected $fillable = ['chaNombreClasificacion',
                        'tstCreacionClasificacion',
                        'tstModificacionClasificacion'];

    //Relacion uno a muchos

    public function Convenios(){ //Realiza las relaciones
        return $this->hasMany(Convenio::class, 'idClasificacion'); //Relacion 1 a n
    }

}
