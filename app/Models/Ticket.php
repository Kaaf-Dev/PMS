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

    public $no_prefix = 'T-';

    const STATUS_NEW = '1';
    const STATUS_UNDER_PROCESSING = '2';
    const STATUS_COMPLETE = '3';
    const STATUS_REJECTED = '4';
    const STATUS_CANCELED = '5';

    const PRIORITY_NORMAL = '1';
    const PRIORITY_URGENT = '2';


    public $incrementing = false;

    protected $fillable = [
        'id',
        'no',
        'contract_id',
        'maintenance_company_id',
        'subject',
        'status',
        'priority',
        'description',
        'visit_at',
        'visited_at',
        'visit_availability_start',
        'visit_availability_end',
        'rate_stars',
        'rate_notes',
    ];

    protected $hidden = [
        'verification_code',
    ];

    protected $casts = [
        'id' => 'string',
        'visit_at' => 'date:Y-m-d H:i',
        'visited_at' => 'date:Y-m-d H:i',
        'visit_availability_start' => 'date:H:i',
        'visit_availability_end' => 'date:H:i',
        'rate_star' => 'integer',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = (string)  Str::uuid();
            if (!$model->status) {
                $model->status = Ticket::STATUS_NEW;
            }

            if ($model->no === null) {
                $model->setAttribute('no', $model->nextNo());
            }

        });
    }

    public function nextNo ()
    {
        $year = date('Y'); // Current year
        $month = date('n'); // Current month

        $max_order = SELF::withTrashed()->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->max('no');

        $max_order = substr($max_order, -7);
        $max_order = (int) $max_order;
        $next_order = $max_order + 1;


        $no = substr($year, 2, 2)
            .str_pad($month, 2, '0', STR_PAD_LEFT)
            .str_pad($next_order, 7, '0', STR_PAD_LEFT);

        return $this->getNoPrefix() . $no;
    }

    public function getNoPrefix()
    {
        return $this->no_prefix;
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id', 'id');
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id', 'id');
    }

    public function apartment()
    {
        return $this->belongsTo(Apartment::class, 'apartment_id', 'id');
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
        return $query->where(function ($query) use ($search) {
            return $query->where('subject', 'like', '%'. $search .'%')
                ->orWhere('description', 'like', '%'. $search .'%')
                ->orWhere('no', 'like', '%'. $search .'%');
        });
    }

    public function scopeContract($query, $contract_id)
    {
        $query->where('contract_id', '=', $contract_id);
    }

    public function scopeUser($query, $user_id)
    {
        $query->whereHas('contract', function ($query) use ($user_id) {
            return $query->where('user_id', $user_id);
        });
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

    public function getVisitAvailabilityStartHumanAttribute()
    {
        return ($this->visit_availability_start) ? $this->visit_availability_start->format('H:i') : '-';
    }

    public function getVisitAvailabilityEndHumanAttribute()
    {
        return ($this->visit_availability_end) ? $this->visit_availability_end->format('H:i') : '-';
    }

    public function hasVisitAvailablityTime()
    {
        return ($this->visit_availability_start or $this->visit_availability_end) === true;
    }

    public static function getStatusList()
    {
        return [
            Ticket::STATUS_NEW => 'جديد',
            Ticket::STATUS_UNDER_PROCESSING => 'قيد الإنجاز',
            Ticket::STATUS_COMPLETE => 'مكتملة',
            Ticket::STATUS_REJECTED => 'مرفوض',
        ];
    }

    public static function getStatusValues()
    {
        return [
            Ticket::STATUS_NEW,
            Ticket::STATUS_UNDER_PROCESSING,
            Ticket::STATUS_COMPLETE,
            Ticket::STATUS_REJECTED,
        ];
    }

    public function getStatusStringAttribute()
    {
        $status = $this->status ?? 1;

        $status_strings = $this->getStatusList();
        return $status_strings[$status] ?? $status_strings[1];
    }

    public function getStatusClassAttribute()
    {
        $status = $this->status ?? 1;
        $status_classes = [
            Ticket::STATUS_NEW => 'info',
            Ticket::STATUS_UNDER_PROCESSING => 'primary',
            Ticket::STATUS_COMPLETE => 'success',
            Ticket::STATUS_REJECTED => 'danger',
            Ticket::STATUS_CANCELED => 'dark',
        ];
        return $status_classes[$status] ?? $status_classes[1];
    }

    public function getStatusIconAttribute()
    {
        $status = $this->status ?? 1;
        $status_icons = [
            Ticket::STATUS_NEW => 'add-files',
            Ticket::STATUS_UNDER_PROCESSING => 'delivery-time',
            Ticket::STATUS_COMPLETE => 'file-added',
            Ticket::STATUS_REJECTED => 'cross-circle',
            Ticket::STATUS_CANCELED => 'delete-folder',
        ];
        return $status_icons[$status] ?? $status_icons[1];
    }

    public static function getPriorityList()
    {
        return [
            Ticket::PRIORITY_NORMAL => 'عادية',
            Ticket::PRIORITY_URGENT => 'طارئة',
        ];
    }

    public static function getPriorityValues()
    {
        return [
            Ticket::PRIORITY_NORMAL,
            Ticket::PRIORITY_URGENT,
        ];
    }

    public function getPriorityStringAttribute()
    {
        $priority = $this->priority ?? 1;

        $priority_strings = $this->getPriorityList();
        return $priority_strings[$priority] ?? $priority_strings[1];
    }


    public function getPriorityClassAttribute()
    {
        $priority = $this->priority ?? 1;
        $priority_classes = [
            Ticket::PRIORITY_NORMAL => 'primary',
            Ticket::PRIORITY_URGENT => 'danger',
        ];
        return $priority_classes[$priority] ?? $priority_classes[1];
    }

    public function getPriorityIconAttribute()
    {
        $priority = $this->priority ?? 1;
        $priority_classes = [
            Ticket::PRIORITY_NORMAL => 'time',
            Ticket::PRIORITY_URGENT => 'information-2',
        ];
        return $priority_classes[$priority] ?? $priority_classes[1];
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

    public function getIsShowVerificationCodeToUserAttribute()
    {
        return $this->status == SELF::STATUS_UNDER_PROCESSING and $this->is_verification_code_sent;
    }

    public function getIsUrgentAttribute()
    {
        return $this->priority == SELF::PRIORITY_URGENT;
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

    public function getIsRatableAttribute()
    {
        return (!$this->rate_star and $this->status == SELF::STATUS_COMPLETE);
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
