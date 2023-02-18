<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contract extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'apartment_id',
        'cost',
        'notes',
        'active',
        'start_at',
        'end_at',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    protected $dates = [
        'start_at',
        'end_at',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Apartment()
    {
        return $this->belongsTo(Apartment::class);
    }

    public function activeScope($query)
    {
        // todo: check active scope from date and flag
        return $query;
    }
}
