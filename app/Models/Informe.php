<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informe extends Model
{
    use HasFactory;
    protected $table = 'v_informes';//reconoce el nombre de la tabla
    protected $primaryKey = 'idInforme';//reconoce el nombre del PK
    const CREATED_AT = 'tstCreacionInforme'; // personaliza el campo created_at
    const UPDATED_AT = 'tstModificacionInforme'; // personaliza el campo updated_at

    protected $fillable = ['idConvenio',
                        'texDescripcionInforme',
                        'chaEstadoInforme',
                        'texUrlInforme',
                        'datFechaPresentacionInforme',
                        'tstCreacionInforme',
                        'tstModificacionInforme'];

    //Relacion muchos a uno inversa

    public function Convenio(){ //Realiza la relacion
        return $this->belongsTo(Convenio::class, 'idConvenio'); //Relacion n a 1 
    }
}
