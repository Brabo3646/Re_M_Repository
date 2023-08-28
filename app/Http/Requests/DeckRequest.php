<?php

namespace App\Http\Requests;

// use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ApiRequest;

class DeckRequest extends ApiRequest
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
            'deck_name' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'deck_name.required' => 'デッキの名前は必須です。',
        ];
    }
}
