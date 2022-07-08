<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dependencia extends Model
{
    use HasFactory;
    protected $table = 'v_dependencias';//reconoce el nombre de la tabla
    protected $primaryKey = 'idDependencia';//reconoce el nombre del PK
    const CREATED_AT = 'tstCreacionDependencia'; // personaliza el campo created_at
    const UPDATED_AT = 'tstModificacionDependencia'; // personaliza el campo updated_at

    protected $fillable = ['vchNombreDependencia',
                        'tstCreacionDependencia',
                        'tstModificacionDependencia'];

    //Relacion uno a muchos

    public function Coordinadores(){ //Realiza las relaciones
        return $this->hasMany(Coordinador::class, 'idDependencia'); //Relacion 1 a n
    }                           // Model            FK relacion      PK
}
