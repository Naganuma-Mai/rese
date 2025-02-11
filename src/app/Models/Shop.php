<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DateTime;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'area_id',
        'genre_id',
        'representative_id',
        'name',
        'overview',
        'image'
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function representative()
    {
        return $this->belongsTo(Representative::class);
    }

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function reservations() {
        return $this->hasMany(Reservation::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function scopeAreaSearch($query, $area_id)
    {
        if (!empty($area_id)) {
            $query->where('area_id', $area_id);
        }
    }

    public function scopeGenreSearch($query, $genre_id)
    {
        if (!empty($genre_id)) {
            $query->where('genre_id', $genre_id);
        }
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }
    }

    public function isVisit($shop_id)
    {
        $exists = Reservation::where('user_id', Auth::id())->where('shop_id', $shop_id)->exists();

        // その店舗に対して現在ログインしているユーザーの予約がある場合
        if ($exists) {
            // 予約を日時の昇順に並び替えて、一番古い予約のみを取得
            $reservation = Reservation::where('user_id', Auth::id())->where('shop_id', $shop_id)->orderBy('date', 'asc')->orderBy('time', 'asc')->first();

            // 現在時刻
            $current_datetime = new DateTime();

            $current_date = $current_datetime->format('Y-m-d');
            $current_time = $current_datetime->format('H:i:s');

            // 来店後（予約日が今日より前または予約日が本日で予約時間が現在時刻以前の場合）
            if ($reservation->date < $current_date or ($reservation->date == $current_date and $reservation->time <= $current_time)) {
                return true;
            // 来店前
            } else {
                return false;
            }

        // その店舗に対して現在ログインしているユーザーの予約がない場合
        } else {
            return false;
        }
    }

    public function isReview($shop_id)
    {
        $exists = Review::where('user_id', Auth::id())->where('shop_id', $shop_id)->exists();

        return $exists;
    }
}
