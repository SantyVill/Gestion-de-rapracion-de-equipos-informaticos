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
}
