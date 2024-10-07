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
        'nationality_id',
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
        'passport_path',
        'corporate_register_path',
        'key_id'
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
        'user_type' => 'integer',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function Nationality()
    {
        return $this->belongsTo(Nationality::class, 'nationality_id', 'id');
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function invoices()
    {
        return $this->hasManyThrough(Invoice::class, Contract::class);
    }

    public function tickets()
    {
        return $this->hasManyThrough(
            Ticket::class, // The related Ticket model class
            Contract::class, // The intermediate Contract model class
            'user_id', // Foreign key on the Contract table referencing User model
            'contract_id', // Foreign key on the Ticket table referencing Contract model
            'id', // Local key on the User model
            'id' // Local key on the Contract model
        );
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

        if ($this->is_person){
            $value = $this->cpr;
        } else {
            $value = $this->corporate_id;
        }

        return $value;
    }

    public function getIsPersonAttribute()
    {
        return (is_null($this->user_type) or $this->user_type == 1);
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

        $user_type = ($this->user_type > 0)
            ? $this->user_type
            : self::USER_TYPE_PERSON;

        return $strings[$user_type];
    }

    public function getGenderStringAttribute()
    {
        $genders = [
            '1' => 'ذكر',
            '2' => 'أنثى',
        ];

        return $genders[$this->gender ?? 1] ?? '-';
    }

    public function getAttachmentDiskPath($attachment)
    {
        return Storage::disk('user_image')->url($this->{$attachment});
    }

    public function getIsBahrinianAttribute()
    {
        return $this->nationality_id == 1;
    }

    public function getIsNonBahrinianAttribute()
    {
        return !($this->getIsBahrinianAttribute());
    }

    public function generateUserName()
    {
        $tokens = $this->email ?? $this->name;
        $tokens = explode(' ', $tokens);
        $username = implode('_', $tokens);

        $max_id = User::max('id');
        $username = ($max_id + 1) . '_' . $username;

        $this->username = $username;
    }

    public function getPhoneHumanAttribute()
    {
        $phone = '-';
        if ($this->is_person) {
            $phone = $this->phone;
        } elseif ($this->is_corporate) {
            $phone = $this->contact_phone;
        }
        return $phone;
    }
}
