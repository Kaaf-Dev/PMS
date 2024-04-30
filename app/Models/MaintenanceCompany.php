<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Jetstream\HasProfilePhoto;

class MaintenanceCompany extends Authenticatable
{
    use HasFactory;
    use HasProfilePhoto;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'contact_name',
        'contact_phone',
        'contact_address',
        'username',
        'password',
        'email'
    ];

    protected $hidden = [
        'password',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class, 'maintenance_company_id', 'id');
    }

    public function getProfilePhotoUrlAttribute()
    {
        return $this->defaultProfilePhotoUrl();
    }
}
