<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'room_id',
        'entry',
        'exit'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class)->withTrashed();
    }

    public function details()
    {
        return $this->hasMany(Detail::class);
    }
}
