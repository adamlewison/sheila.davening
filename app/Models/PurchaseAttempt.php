<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'item_id', 'first_name', 'last_name', 'email', 'sponsor_by', 'merit_of', 'show_on_app', 'completed_at', 'payment_vendor_response'
    ];

    public function item() {
        return $this->belongsTo(Item::class);
    }

    public function completed() {
        return isset($this->completed_at);
    }

    public function paymentReference() {
        return substr("D" . (($this->item_id * 31)) . "" . strtoupper(substr($this->email, 0, strpos($this->email, "@"))), 0, 7);
    }
    
}
