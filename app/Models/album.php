<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class album extends Model
{
    use HasFactory;

    protected $table = 'albums';
    protected $fillable = ['name', 'google_drive_folder_id'];

    public function photos()
    {
        return $this->hasMany(photos::class);
    }
}
