<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class PropertyFile extends Model
{
    protected $table = 'property_files';
    protected $fillable = ['property_id', 'file_name', 'file_path'];


    public function Property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function getMainImagePathAttribute()
    {
        if (Storage::disk('property_file')->exists($this->file_path)) {
            $url = Storage::disk('property_file')->url($this->file_path);
        } else {
            $url = '#';
        }

        return $url;
    }

    use HasFactory;
}
