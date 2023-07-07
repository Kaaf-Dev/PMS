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
    const STATUS_UNDER_COMPLETE = '5';
    const STATUS_REJECTED = '6';
    const STATUS_UNDER_CANCELED = '7';


    public $incrementing = false;

    protected $fillable = [
        'id',
        'subject',
        'status',
        'description',
        'visit_at',
        'visited_at',
    ];

    protected $casts = [
        'id' => 'string',
        'visit_at' => 'date',
        'visited_at' => 'date',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = (string)  Str::uuid();
        });
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id', 'id');
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
            Ticket::STATUS_UNDER_COMPLETE => 'تم الإنجاز',
            Ticket::STATUS_REJECTED => 'مرفوض',
//            Ticket::STATUS_UNDER_CANCELED => 'ملغي',
        ];
    }

    public function getStatusStringAttribute()
    {
        $status = $this->status ?? 1;
        $status_strings = [
            1 => 'جديد',
            2 => 'قيد الدراسة',
            3 => 'بحاجة إلى استكمال',
            4 => 'قيد المعالجة',
            5 => 'تم الإنجاز',
            6 => 'مرفوض',
            7 => 'ملغي',
        ];
        return $status_strings[$status];
    }

    public function getStatusClassAttribute()
    {
        $status = $this->status ?? 1;
        $status_classes = [
            1 => 'info',
            2 => 'info',
            3 => 'warning',
            4 => 'primary',
            5 => 'success',
            6 => 'danger',
            7 => 'dark',
        ];
        return $status_classes[$status];
    }

    public function getStatusIconAttribute()
    {
        $status = $this->status ?? 1;
        $status_icons = [
            1 => 'add-files',
            2 => 'watch',
            3 => 'information',
            4 => 'delivery-time',
            5 => 'file-added',
            6 => 'cross-circle',
            7 => 'delete-folder',
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

    public function getCreatedAtHumanAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function getUpdatedAtHumanAttribute()
    {
        return Carbon::parse($this->updated_at)->diffForHumans();
    }
}
