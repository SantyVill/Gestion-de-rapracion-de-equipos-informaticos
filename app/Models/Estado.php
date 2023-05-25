<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';
    protected $fillable = ['estado'];
    protected $hidden = ['created_at','updated_at'];
    use HasFactory;
    public function opSelected($estado){
        if (strcmp($this->estado,$estado)==0) {
            return 'selected';
        }
        return '';
    }

    public static function transicionEstados($estadoActual){
        switch ($estadoActual) {
            case 'A Presupuestar':
                return ['En Revisión'];
                break;
            case 'En Revisión':
                return ['Presupuesto Realizado'];
                break;
            case 'Presupuesto Realizado':
                return ['Presupuesto Aceptado'];
                break;
            case 'Presupuesto Aceptado':
                return ['En Reparación'];
                break;
            case 'En Reparación':
                return ['Reparación Terminada','Presupuesto Realizado'];
                break;
            case 'Reparación Terminada':
                return ['Equipo Entregado'];
                break;
            case 'Equipo Entregado':
                return [''];
                break;
            default:
                return [''];
                break;
        }
    }
}
