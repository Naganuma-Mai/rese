<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'shop_id',
        'date',
        'time',
        'number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function isVisit()
    {
        $today = new DateTime();
        $today = $today->format('Y-m-d');

        // 来店後
        if ($this->date < $today) {
            return true;
        // 来店前
        } else {
            return false;
        }
    }

    public function scopeShopSearch($query, $shop_id)
    {
        if (!empty($shop_id)) {
            $query->where('shop_id', $shop_id);
        }
    }
}
