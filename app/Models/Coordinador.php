<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coordinador extends Model
{
    use HasFactory;
    protected $table = 'v_coordinadores';//reconoce el nombre de la tabla
    protected $primaryKey = 'idCoordinador';//reconoce el nombre del PK
    const CREATED_AT = 'tstCreacionCoordinador'; // personaliza el campo created_at
    const UPDATED_AT = 'tstModificacionCoordinador'; // personaliza el campo updated_at

    /**
     * Datos a ser llenados en la tabla
     */
    protected $fillable = ['idDependencia',
                        'chaNombreCoordinador',
                        'chaTituloCoordinador',
                        'chaCargoCoordinador',
                        'chaCelularCoordinador',
                        'tstCreacionCoordinador',
                        'tstModificacionCoordinador'];

    /**
     * Relaciones con demás modelos
     */
    //Relacion muchos a uno inversa

    public function Dependencia(){ //Realiza la relacion
        return $this->belongsTo(Dependencia::class, 'idDependencia'); //Relacion n a 1 
    }

    //Relacion muchos a muchos 
    public function Convenios(){ //Realiza la relacion
        return $this->belongsToMany(Convenio::class, 'v_convenios_coordinadores', 'idCoordinador', 'idConvenio')->withPivot('chaEstadoCoordinador'); //Relacion n a n 
    }

    public function Resoluciones(){
        return $this->belongsToMany(Resolucion::class, 'v_coordinadores_resoluciones', 'idCoordinador' ,'idResolucion');
    }
}
