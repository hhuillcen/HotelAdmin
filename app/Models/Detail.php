<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Detail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'invoice_id',
        'item_id',
        'price',
        'quantity',
    ];

    public function item()
    {
        return $this->belongsTo(Item::class)->withTrashed();
    }
}
