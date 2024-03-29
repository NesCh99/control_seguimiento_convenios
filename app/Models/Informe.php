<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informe extends Model
{
    use HasFactory;
    protected $table = 'v_informes';//reconoce el nombre de la tabla
    protected $primaryKey = 'idInforme';//reconoce el nombre del PK
    public $timestamps = false; //deshabilita los campos created_at y updated_at

    protected $fillable = ['idConvenio',
                        'datFechaInicioInforme',
                        'datFechaFinInforme',
                        'tstFechaPresentacionInforme',
                        'chaEstadoInforme',
                        ];

    //Relacion muchos a uno inversa

    public function Convenio(){ //Realiza la relacion
        return $this->belongsTo(Convenio::class, 'idConvenio'); //Relacion n a 1 
    }
}
