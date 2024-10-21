<?php

namespace App\Http\Requests\Teacher;

use Illuminate\Foundation\Http\FormRequest;

class QuizRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'time'=>'required',
            'questions' => 'required',
            'questions.*.questionText' => 'required',
            'questions.*.options' => 'required',
            'questions.*.options.*.optionText' => 'required',
            'questions.*.options.*.isCorrect' => 'required',
        ];
    }
}
