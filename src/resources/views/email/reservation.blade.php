<div class="reservation-content">
    <p>{{ $reservation->user->name }}さん</p>
    <p>ご予約いただいた飲食店へのご来店日が本日となりましたので、再度ご連絡させていただきます。ぜひ、素敵な時間をお過ごしください。</p>
</div>

<div class="reservation-table">
    <table class="reservation-table__inner">
        <tr class="reservation-table__row">
            <th class="reservation-table__header">飲食店名:</th>
            <td class="reservation-table__text">
                {{ $reservation->shop->name }}
            </td>
        </tr>
        <tr class="reservation-table__row">
            <th class="reservation-table__header">予約日時:</th>
            <td class="reservation-table__text">
                {{ $reservation->date }}&nbsp;{{ substr($reservation->time, 0, 5) }}
            </td>
        </tr>
        <tr class="reservation-table__row">
            <th class="reservation-table__header">予約人数:</th>
            <td class="reservation-table__text">
                {{ $reservation->number }}人
            </td>
        </tr>
    </table>
</div>
