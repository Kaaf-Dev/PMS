<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    const USER_TYPE_PERSON = 1;
    const USER_TYPE_CORPORATE = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'cpr',
        'corporate_id',
        'gender',
        'phone',
        'blood',
        'date_of_berth',
        'contact_name',
        'contact_phone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_of_berth' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function invoices()
    {
        return $this->hasManyThrough(Invoice::class, Contract::class);
    }

    public function getProfilePhotoUrlAttribute()
    {
        return ($this->user_image_path)
            ? asset('user-image/'.$this->user_image_path)
            : $this->defaultProfilePhotoUrl();
    }

    public function getIdHumanAttribute()
    {
        $value = '';

        if ($this->user_type == 1){
            $value = $this->cpr;
        } else {
            $value = $this->corporate_id;
        }

        return $value;
    }

    public function getIsPersonAttribute()
    {
        return $this->user_type != 2;
    }

    public function getIsCorporateAttribute()
    {
        return $this->user_type == 2;
    }

    public function getUserTypeHumanAttribute()
    {
        $strings = [
            self::USER_TYPE_PERSON => 'فئة أفراد',
            self::USER_TYPE_CORPORATE => 'فئة شركات',
        ];

        return $strings [$this->user_type];
    }

    public function getAttachmentDiskPath($attachment)
    {
        return Storage::disk('user_image')->url($this->{$attachment});

    }
}
