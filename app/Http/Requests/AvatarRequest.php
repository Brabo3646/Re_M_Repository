<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ApiRequest;

class AvatarRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'avatar_name' =>'required',
            'avatar_ID' => 'required|unique:avatars',
            'introduce' => 'max:255',
        ];
    }
    public function messages()
    {
        return [
            'avatar_name.required' => 'アバターの名前は必須です。',
            'avatar_ID.required' => 'アバターのIDは必須です。',
            'avatar_ID.unique' => 'そのIDは既に使われているようです...',
            'introduce.max' => '最大２５５文字までです。',
        ];
    }
}
