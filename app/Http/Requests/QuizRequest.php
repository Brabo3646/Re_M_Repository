<?php

namespace App\Http\Requests;

// use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\ApiRequest;

class QuizRequest extends ApiRequest
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
    public function rules():
    {
        return [
            'question' => 'required',
            'answer' => 'required',
        ];
    }
    
    public function messages()
    {
        return [
            'question.required' => '問題が記入されていません。',
            'answer.required' => '解答が記入されていません。'
        ];
    }
}
