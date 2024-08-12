<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Auth;

class ReservationController extends Controller
{
    public function store(Request $request)
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

        return view('done');
    }

    // public function update(TodoRequest $request)
    // {
    //     $todo = $request->only(['content']);
    //     Reservation::find($request->id)->update($todo);

    //     return redirect('/')->with('message', 'Todoを更新しました');
    // }

    public function destroy(Request $request)
    {
        Reservation::find($request->id)->delete();

        return redirect('/mypage');
    }
}
