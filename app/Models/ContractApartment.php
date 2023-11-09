<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContractApartment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'contract_apartment';

    protected $fillable = [
        'contract_id',
        'apartment_id',
        'cost',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}
