<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => ['required', 'after:today'],
            'time' => ['required'],
            'number' => ['required', 'min:1', 'max:100']
        ];
    }

    public function messages()
    {
        return [
            'date.required' => '日付を選択してください',
            'date.after' => '日付は翌日以降で選択してください',
            'time.required' => '時間を選択してください',
            'number.required' => '人数を選択してください',
            'number.min' => '人数は1人以上で選択してください',
            'number.max' => '人数は100人以下で選択してください'
        ];
    }
}
