<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistroPrestamo extends Model
{
    protected $fillable=['nombre','numero_cuenta','fecha','cantidad','id_recurso'];

    protected $appends=["recurso"];

    public function getRecursoAttribute(){
        $recurso = Recurso::findOrFail($this->id_recurso);
        return $recurso;
    }
}
