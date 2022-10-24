<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convenio extends Model
{
    use HasFactory;
    protected $table = 'v_convenios';//reconoce el nombre de la tabla
    protected $primaryKey = 'idConvenio';//reconoce el nombre del PK
    const CREATED_AT = 'tstCreacionConvenio'; // personaliza el campo created_at
    const UPDATED_AT = 'tstModificacionConvenio'; // personaliza el campo updated_at

    protected $fillable = ['idClasificacion',
                        'idResolucion',
                        'texNombreConvenio',
                        'texObjetoConvenio',
                        'datFechaInicioConvenio',
                        'datFechaFinConvenio',
                        'chaEstadoConvenio',
                        'texUrlConvenio',
                        'tstCreacionConvenio',
                        'tstModificacionConvenio'];

    
    //Relacion uno a muchos
    public function Informes(){
        return $this->hasMany(Informe::class, 'idConvenio');
    }
    //Relacion muchos a uno inversa

    public function Clasificacion(){ //Realiza la relacion
        return $this->belongsTo(Clasificacion::class, 'idClasificacion'); //Relacion n a 1 
    }
    public function Resolucion(){ //Realiza la relacion
        return $this->belongsTo(Resolucion::class,'idResolucion'); //Relacion n a 1
    }

    //Relacion muchos a muchos 
    public function Ejes(){ //Realiza la relacion
        return $this->belongsToMany(Eje::class, 'v_convenios_ejes', 'idConvenio', 'idEje'); //Relacion n a n 
    }
 
    public function Coordinadores(){ //Realiza la relacion
        return $this->belongsToMany(Coordinador::class, 'v_convenios_coordinadores', 'idConvenio', 'idCoordinador')->withPivot('chaTipoCoordinador','chaEstadoCoordinador','chaNombreResolucion'); //Relacion n a n 
    }

    

}
