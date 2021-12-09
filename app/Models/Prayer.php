<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prayer extends Model
{
    use HasFactory;

    protected $fillable = [
        'prayer',
        'category',
        'sub_category',
        'show_name',
        'price'
    ];

    public function items() {
        return $this->hasMany(Item::class);
    }

    public function ari() {
        return $this->hasOne(Item::class)->whereNusach(1);
    }

    public function ashkenaz() {
        return $this->hasOne(Item::class)->whereNusach(2);
    }

    /*
     * STATIC METHODS
     */

    public static function categories() {
        return [
            0 => 'Shacharit',
            1 => 'Hallel',
            2 => 'Before Brochas',
            3 => 'After Brochas'
        ];
    }

    public static function category($cat) {
        return Prayer::where('category', $cat);
    }
}
