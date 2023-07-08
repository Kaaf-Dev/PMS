<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketReply extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'ticket_id',
        'user_id',
        'admin_id',
        'maintenance_company',
        'content',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function maintenanceCompany()
    {
        return $this->belongsTo(MaintenanceCompany::class, 'maintenance_company_id', 'id');
    }

    public function author()
    {
        if ($this->is_admin) {
            return $this->belongsTo(Admin::class);

        } elseif ($this->is_maintenance_company) {
            return $this->belongsTo(MaintenanceCompany::class);

        } elseif ($this->is_user) {
            return $this->belongsTo(User::class);
        }
    }

    public function getAuthorNameAttribute()
    {
        $name = '-';

        if ($this->is_admin) {
            $name = $this->admin->name;

        } elseif ($this->is_maintenance_company) {
            $name = $this->maintenanceCompany->name;

        } elseif ($this->is_user) {
            $name = $this->user->name;
        }

        return $name;
    }

    public function getAuthorClassAttribute()
    {
        $class = 'light';
        if ($this->is_admin) {
            $class = 'danger';

        } elseif ($this->is_maintenance_company) {
            $class = 'success';

        } elseif ($this->is_user) {
            $class = 'info';
        }

        return $class;
    }

    public function getAuthorStringAttribute()
    {
        $string = '';
        if ($this->is_admin) {
            $string = 'مدير النظام';

        } elseif ($this->is_maintenance_company) {
            $string = 'شركة الصيانة';
        } elseif ($this->is_user) {
            $string = 'المستأجر';
        }

        return $string;
    }

    public function getIsAdminAttribute()
    {
        return !is_null($this->admin_id);
    }

    public function getIsUserAttribute()
    {
        return !is_null($this->user);
    }

    public function getIsMaintenanceCompanyAttribute()
    {
        return !is_null($this->maintenanceCompany);
    }

    public function getUpdatedAtHumanAttribute()
    {
        return Carbon::parse($this->updated_at)->diffForHumans();
    }
}
