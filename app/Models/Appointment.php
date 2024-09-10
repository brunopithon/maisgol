<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'coach_id',
        'field_id',
        'group_id',
        'start_time',
        'day'
    ];

    /**
     * Get the coach associated with the appointment.
     */
    public function coach()
    {
        return $this->belongsTo(Coach::class);
    }

    /**
     * Get the field associated with the appointment.
     */
    public function field()
    {
        return $this->belongsTo(Field::class);
    }

    /**
     * Get the group associated with the appointment.
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
