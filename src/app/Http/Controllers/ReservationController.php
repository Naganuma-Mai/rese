<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Auth;

class ReservationController extends Controller
{
    public function search(Request $request)
    {
        $reservations = Reservation::with(['user'])->ShopSearch($request->shop_id)->get();

        return view('reservation', compact('reservations'));
    }

    public function store(ReservationRequest $request)
    {

        $request['user_id'] = Auth::id();
        Reservation::create(
            $request->only([
                'user_id',
                'shop_id',
                'date',
                'time',
                'number'
            ])
        );

        $shop_id = $request->shop_id;

        return view('done', compact('shop_id'));
    }

    public function edit(Request $request)
    {
        $reservation = Reservation::find($request->id);
        return view('edit', compact('reservation'));
    }

    public function update(ReservationRequest $request)
    {
        $reservation = $request->only(['date', 'time', 'number']);
        Reservation::find($request->reservation_id)->update($reservation);

        return redirect('/mypage');
    }

    public function destroy(Request $request)
    {
        Reservation::find($request->id)->delete();

        return redirect('/mypage');
    }

    public function showQrCode()
    {
        return view('qr_code');
    }
}
