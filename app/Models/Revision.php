<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    protected $table = 'revisions';
    protected $fillable = ['nota','fecha','Observación'];
    protected $hidden = ['create_at','update_at'];
    use HasFactory;
}
