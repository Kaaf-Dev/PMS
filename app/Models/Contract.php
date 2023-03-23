<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function scopeActive($query, Carbon $date = null)
    {
        $current_date = $date ?? Carbon::now(); // get date from parameter or get now date
        $query->where('active', '=', '1') // check activation flag
        ->where(function($query) use ($current_date){ // check date flag
            $query->whereRaw('? BETWEEN `start_at` AND `end_at`', [$current_date->format('Y-m-01')])
                ->orWhereRaw('`start_at` <= ? and `end_at` IS NULL', [$current_date->format('Y-m-01')]);
        });
        return $query;
    }

    public function getActiveStatusAttribute()
    {
        $current_date = Carbon::now();
        $start_at = $this->start_at;
        $end_at = $this->end_at;
        $is_active = false;

        if ($this->active) {
            if ($start_at and $end_at) {
                $is_active = $current_date->between($start_at, $end_at);
            } elseif ($start_at) {
                $is_active = $current_date->lte($start_at);
            }
        }
        return $is_active;
    }

    public function getActiveStatusStringAttribute()
    {
        $strings = [
            0 => 'غير فعّال',
            1 => 'فعّال',
        ];

        return $strings[$this->active_status ?? 0];
    }

    public function getActiveStatusClassAttribute()
    {
        $strings = [
            0 => 'danger',
            1 => 'success',
        ];

        return $strings[$this->active_status ?? 0];
    }

    public function cancel()
    {
        $this->active = false;
        return ($this->save());
    }
}
