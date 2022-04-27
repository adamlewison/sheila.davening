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
        return isset($this->purchase_attempted_at);
        # return isset($this->purchase_attempted_at) && Carbon::now()->diffInMinutes($this->purchase_attempted_at) < 30;
    }

    public function available() {
        return !$this->purchased() && !$this->onHold();
    }

    public function prayer() {
        return $this->belongsTo(Prayer::class);
    }

    public function purchaseAttempts() {
        return $this->hasMany(PurchaseAttempt::class);
    }

    public function purchaseAttempt() {
        if ($this->available()) {
            return null;
        } else {
            return $this->purchaseAttempts->last();
        }
    }

    public function purchaseDetails() {
        return $this->purchaseAttempts()->whereNotNull('completed_at')->first();
    }
    public static function category($cat) {
        return Item::whereHas('prayer', function ($q) use ($cat) {
            $q->where('category', $cat);
        });
    }
}
