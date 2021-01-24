<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    protected $table = 'clientes';
    protected $primaryKey = 'id_Cliente';

    public $timestamps = false;


    public function mascota(){
        return $this->hasMany(Mascotas::class);
    }
}
