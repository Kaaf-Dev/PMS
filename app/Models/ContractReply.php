<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContractReply extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'contract_id',
        'lawyer_id',
        'admin_id',
        'content',
    ];

    public function Contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }

    public function Lawyer()
    {
        return $this->belongsTo(Lawyer::class, 'lawyer_id', 'id');
    }

    public function author()
    {
        if ($this->is_admin) {
            return $this->belongsTo(Admin::class);

        } elseif ($this->is_lawyer) {
            return $this->belongsTo(Lawyer::class);

        }
    }

    public function getAuthorNameAttribute()
    {
        $name = '-';

        if ($this->is_admin) {
            $name = $this->admin->name;

        } elseif ($this->lawyer) {
            $name = $this->lawyer->name;

        }

        return $name;
    }

    public function getAuthorClassAttribute()
    {
        $class = 'light';
        if ($this->is_admin) {
            $class = 'danger';

        } elseif ($this->is_lawyer) {
            $class = 'success';

        }

        return $class;
    }

    public function getAuthorStringAttribute()
    {
        $string = '';
        if ($this->is_admin) {
            $string = 'مدير النظام';

        } elseif ($this->is_lawyer) {
            $string = 'المحامي';
        }

        return $string;
    }

    public function getIsAdminAttribute()
    {
        return !is_null($this->admin_id);
    }

    public function getIsLawyerAttribute()
    {
        return !is_null($this->lawyer);
    }

    public function getUpdatedAtHumanAttribute()
    {
        return Carbon::parse($this->updated_at)->diffForHumans();
    }

}
