<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class photos extends Model
{
    use HasFactory;

    protected $table = 'photos';
    protected $fillable = ['album_id', 'name', 'google_drive_file_id', 'google_drive_file_url'];

    public function album()
    {
        return $this->belongsTo(Album::class);
    }    
}
