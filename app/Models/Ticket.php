<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'subject',
        'status',
        'description',
        'visit_at',
        'visited_at',
    ];

    protected $casts = [
        'id' => 'string',
        'visit_at' => 'date',
        'visited_at' => 'date',
    ];
}
