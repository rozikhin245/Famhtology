<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activities';

    protected $fillable = [
        'name',
        'location',
        'date',
        'start_time',
        'end_time',
        'description',
        'icon',
        'notes',
        'album_id',
    ];

    /**
     * Relasi ke Album (setiap activity bisa memiliki satu album dokumentasi)
     */
    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    /**
     * Getter otomatis untuk notes jika disimpan dalam format JSON
     */
    protected $casts = [
        'notes' => 'array',
    ];
}
