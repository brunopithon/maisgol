<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Athlete extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'responsible_name',
        'responsible_CPF',
        'responsible_email',
        'responsible_phone',
        'cpf',
        'height',
        'weight',
        'birth_date',
        'gender',
        'cep',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
    ];
}
