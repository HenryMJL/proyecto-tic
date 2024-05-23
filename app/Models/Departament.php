<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departament extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Campos permitidos para realizar la persistencia de Datos
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];

    /**
     * Relacion con los usuarios desde el departamento.
     *
     * @return void
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
