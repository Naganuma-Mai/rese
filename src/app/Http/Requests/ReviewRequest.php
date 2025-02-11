<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
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
        $rules = [
            'star' => ['required', 'digits_between:1,5'],
            'comment' => ['required', 'string', 'max:400'],
        ];

        if (!$this->filled('review_id')) {
            // 新規作成時は画像を必須
            $rules['image'] = ['required', 'image', 'mimes:jpeg,png'];
        } else {
            // 更新時は画像を任意
            $rules['image'] = ['nullable', 'image', 'mimes:jpeg,png'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'star.required' => '星の数を選択してください',
            'star.digits_between' => '星の数を1から5の間で選択してください',
            'comment.required' => '口コミを入力してください',
            'comment.string' => '口コミを文字列で入力してください',
            'comment.max' => '口コミを400文字以内で入力してください',
            'image.required' => '画像を追加してください',
            'image.image' => '画像ファイルを追加してください',
            'image.mimes' => '画像ファイルの拡張子はjpeg、pngとしてください'
        ];
    }
}
