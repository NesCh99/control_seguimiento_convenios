<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Eje extends Model
{
    use HasFactory;
    protected $table = 'v_ejes';//reconoce el nombre de la tabla
    protected $primaryKey = 'idEje';//reconoce el nombre del PK
    const CREATED_AT = 'tstCreacionEje'; // personaliza el campo created_at
    const UPDATED_AT = 'tstModificacionEje'; // personaliza el campo updated_at

    protected $fillable = ['chaNombreEje',
                        'tstCreacionEje',
                        'tstModificacionEje'];

    //Relacion muchos a muchos 
    public function Convenios(){ //Realiza la relacion
        return $this->belongsToMany(Convenio::class, 'v_convenios_ejes', 'idEje', 'idConvenio'); //Relacion n a n 
    }
}
