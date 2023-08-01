<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeckRequest extends FormRequest
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
            'name' => 'required',
            'quiztype' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'デッキの名前は必須です。',
            'quiztype.required' => 'クイズのタイプを選んでください。',
        ];
    }
}
