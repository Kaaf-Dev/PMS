<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Jetstream\HasProfilePhoto;

class Lawyer extends Authenticatable
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
    ];

    protected $hidden = [
        'password',
    ];

    protected $appends = [
        'profile_photo_url',
    ];

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function contractReplies()
    {
        return $this->hasMany(ContractReply::class, 'contract_id', 'id');
    }

    public function cases()
    {
        return $this->hasMany(LawyerCase::class, 'lawyer_id', 'id');
    }

    public function getProfilePhotoUrlAttribute()
    {
        return $this->defaultProfilePhotoUrl();
    }
}
