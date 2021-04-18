<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreIllustration extends FormRequest
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
            'comment' => 'required|max:50',
        ];
    }

    public function messages()
    {
        return [
            'comment.max' => '投稿者コメントは50文字以下で入力して下さい。',
            'comment.required' => '投稿者コメントを入力して下さい。',
        ];
    }
}
