<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'prayer_id',
        'price',
        'nusach',
        'purchase_attempted_at',
        'purchased_at'
    ];

    const NUSACH = [
        0 => 'Both',
        1 => 'Ari',
        2 => 'Ashkenaz'
    ];

    public function purchased() {
        return isset($this->purchased_at);
    }

    public function onHold() {
        return isset($this->purchase_attempted_at) && Carbon::now()->diffInMinutes($this->purchase_attempted_at) < 8;
    }

    public function available() {
        return !$this->purchased() && !$this->onHold();
    }

    public function prayer() {
        return $this->belongsTo(Prayer::class);
    }
}
