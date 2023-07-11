<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Ticket extends Model
{
    use HasFactory;
    use SoftDeletes;

    const STATUS_NEW = '1';
    const STATUS_PENDING = '2';
    const STATUS_INCOMPLETE = '3';
    const STATUS_UNDER_PROCESSING = '4';
    const STATUS_COMPLETE = '5';
    const STATUS_REJECTED = '6';
    const STATUS_CANCELED = '7';


    public $incrementing = false;

    protected $fillable = [
        'id',
        'contract_id',
        'maintenance_company_id',
        'subject',
        'status',
        'description',
        'visit_at',
        'visited_at',
    ];

    protected $hidden = [
        'verification_code',
    ];

    protected $casts = [
        'id' => 'string',
        'visit_at' => 'date:Y-m-d H:i',
        'visited_at' => 'date:Y-m-d H:i',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = (string)  Str::uuid();
            if (!$model->status) {
                $model->status = Ticket::STATUS_NEW;
            }
        });
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id', 'id');
    }

    public function maintenanceCompany()
    {
        return $this->belongsTo(MaintenanceCompany::class, 'maintenance_company_id', 'id');
    }

    public function ticketCategory()
    {
        return $this->belongsTo(TicketCategory::class, 'ticket_category_id', 'id');
    }

    public function ticketReplies()
    {
        return $this->hasMany(TicketReply::class);
    }

    public function ticketAttachments()
    {
        return $this->hasMany(TicketAttachment::class, 'ticket_id', 'id');
    }

    public function scopeOpened($query)
    {
        return $query->where(function () use ($query) {
            return $query->where('status', '=', Ticket::STATUS_NEW)
                ->orWhere('status', '=', Ticket::STATUS_PENDING)
                ->orWhere('status', '=', Ticket::STATUS_INCOMPLETE)
                ->orWhere('status', '=', Ticket::STATUS_UNDER_PROCESSING);
        });
    }

    public function scopeVisitIn($query, $visit_in)
    {
        if ( in_array($visit_in, [
            'day',
            'week',
            'month',
        ]))  {

            $now = Carbon::now();
            $start_of_range = $now->format('Y-m-d H:i:s');
            $end_of_range = $start_of_range;
            if ($visit_in == 'day') {
                $end_of_range = $now->addDay()->format('Y-m-d H:i:s');

            } elseif ($visit_in == 'week') {
                $end_of_range = $now->addDays(7)->format('Y-m-d H:i:s');

            } elseif($visit_in == 'month') {
                $end_of_range = $now->addMonth()->format('Y-m-d H:i:s');

            }
            return $query->whereBetween('visit_at', [$start_of_range, $end_of_range]);
        }
    }

    public function scopeSearch($query, $search)
    {

    }

    public function scopeContract($query, $contract_id)
    {
        $query->where('contract_id', '=', $contract_id);
    }

    public function getTruncatedDescriptionAttribute()
    {
        $string = $this->description;
        $wordCount = 25;
        $words = explode(' ', $string);
        $append = ' ...';

        if (count($words) <= $wordCount) {
            return $string;
        }

        $truncatedString = implode(' ', array_slice($words, 0, $wordCount));

        return $truncatedString . $append;
    }

    public static function getStatusList()
    {
        return [
            Ticket::STATUS_NEW => 'جديد',
            Ticket::STATUS_PENDING => 'قيد الدراسة',
            Ticket::STATUS_INCOMPLETE => 'بحاجة إلى استكمال',
            Ticket::STATUS_UNDER_PROCESSING => 'قيد المعالجة',
            Ticket::STATUS_COMPLETE => 'تم الإنجاز',
            Ticket::STATUS_REJECTED => 'مرفوض',
//            Ticket::STATUS_CANCELED => 'ملغي',
        ];
    }

    public static function getStatusValues()
    {
        return [
            Ticket::STATUS_NEW,
            Ticket::STATUS_PENDING,
            Ticket::STATUS_INCOMPLETE,
            Ticket::STATUS_UNDER_PROCESSING,
            Ticket::STATUS_COMPLETE,
            Ticket::STATUS_REJECTED,
//            Ticket::STATUS_CANCELED,
        ];
    }

    public function getStatusStringAttribute()
    {
        $status = $this->status ?? 1;

        $status_strings = $this->getStatusList();
        return $status_strings[$status];
    }

    public function getStatusClassAttribute()
    {
        $status = $this->status ?? 1;
        $status_classes = [
            Ticket::STATUS_NEW => 'info',
            Ticket::STATUS_PENDING => 'info',
            Ticket::STATUS_INCOMPLETE => 'warning',
            Ticket::STATUS_UNDER_PROCESSING => 'primary',
            Ticket::STATUS_COMPLETE => 'success',
            Ticket::STATUS_REJECTED => 'danger',
            Ticket::STATUS_CANCELED => 'dark',
        ];
        return $status_classes[$status];
    }

    public function getStatusIconAttribute()
    {
        $status = $this->status ?? 1;
        $status_icons = [
            Ticket::STATUS_NEW => 'add-files',
            Ticket::STATUS_PENDING => 'watch',
            Ticket::STATUS_INCOMPLETE => 'information',
            Ticket::STATUS_UNDER_PROCESSING => 'delivery-time',
            Ticket::STATUS_COMPLETE => 'file-added',
            Ticket::STATUS_REJECTED => 'cross-circle',
            Ticket::STATUS_CANCELED => 'delete-folder',
        ];
        return $status_icons[$status];
    }

    public function getCancelableAttribute()
    {
        return $this->status <= SELF::STATUS_UNDER_PROCESSING;
    }

    public function getRepliableAttribute()
    {
        return $this->status <= SELF::STATUS_UNDER_PROCESSING;
    }

    public function getFinishableAttribute()
    {
        return $this->status == SELF::STATUS_UNDER_PROCESSING;
    }

    public function getIsVerificationCodeSentAttribute()
    {
        return !(is_null($this->verification_code));
    }

    public function getIsChangeVisitAtAttribute()
    {
        return $this->status <= SELF::STATUS_UNDER_PROCESSING;
    }

    public function getCreatedAtHumanAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function getUpdatedAtHumanAttribute()
    {
        return Carbon::parse($this->updated_at)->diffForHumans();
    }

    public function getUpdatedAtDateHumanAttribute()
    {
        return Carbon::parse($this->updated_at)->format('Y.m.d H:ia');
    }

    public function getVisitInHumanAttribute()
    {
        $date = '-';
        if ($this->visit_at) {
            $date = Carbon::parse($this->visit_at)->diffForHumans();
        }
        return $date;
    }

    public function getVisitInDateHumanAttribute()
    {
        $date = '-';
        if ($this->visit_at) {
            $date = Carbon::parse($this->visit_at)->format('Y.m.d H:ia');
        }
        return $date;
    }

    public function getVisitedAtHumanAttribute()
    {
        $date = '-';
        if ($this->visited_at) {
            $date = Carbon::parse($this->visited_at)->diffForHumans();
        }
        return $date;
    }

    public function getVisitedAtDateHumanAttribute()
    {
        $date = '-';
        if ($this->visited_at) {
            $date = Carbon::parse($this->visited_at)->format('Y.m.d H:ia');
        }
        return $date;
    }

    public function generateVerificationCode()
    {
        $verification_code = rand(100000, 999999);
        $this->verification_code = $verification_code;
    }

    public function finish()
    {
        $this->visited_at = now();
        $this->status = SELF::STATUS_COMPLETE;
    }
}
