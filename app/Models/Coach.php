<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coach extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cpf',
        'status',
        'birth_date',
        'email',
        'timetable',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'timetable' => 'array',
        // 'birth_date' => 'date',
    ];
}
