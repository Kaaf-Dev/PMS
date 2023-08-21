<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class TicketReplyAttachment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'ticket_reply_id',
        'path',
        'file_name',
    ];

    public function TicketReply()
    {
        return $this->belongsTo(TicketReply::class);
    }

    public function getUrlAttribute()
    {
        $url = '#';
        if (Storage::disk('ticket_attachments')->exists($this->path)) {
            $url = Storage::disk('ticket_attachments')->url($this->path);
        }
        return $url;
    }
}
