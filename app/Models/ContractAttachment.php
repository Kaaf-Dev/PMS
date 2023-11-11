<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ContractAttachment extends Model
{
    protected $table = 'contract_attachments';
    protected $fillable = ['contract_id', 'file_name', 'file_path'];

    public function getMainImagePathAttribute()
    {
        if (Storage::disk('contract_file')->exists($this->file_path)) {
            $url = Storage::disk('contract_file')->url($this->file_path);
        } else {
            $url = '#';
        }

        return $url;
    }

    use HasFactory;
}
