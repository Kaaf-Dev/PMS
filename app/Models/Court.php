<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Court extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function lawyerCases()
    {
        return $this->hasMany(LawyerCase::class, 'court_id', 'id');
    }
}
