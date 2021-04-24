<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddComment extends FormRequest
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
            'add_comment' => 'required|max:50',
        ];
    }

    public function messages()
    {
        return [
            'add_comment.max' => 'コメントは50文字以下で入力して下さい。',
            'add_comment.required' => 'コメントを入力して下さい。',
        ];
    }
}
