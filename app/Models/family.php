<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class family extends Model
{
    protected $fillable = ['Full_name', 'Nick_name', 'gender', 'domisili', 'parent_id', 'spouse_id', 'generation_code', 'photo', 'status', 'created_by'];

    protected $table = 'family';

    use HasFactory;

    public function parent()
    {
        return $this->belongsTo(family::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(family::class, 'parent_id');
    }
    public function spouse()
    {
        return $this->belongsTo(family::class, 'spouse_id');
    }
    public function marriedWith()
    {
        return $this->hasOne(family::class, 'spouse_id');
    }
}
