<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UrlsStoreRequest extends FormRequest
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
            'name' => ['required','unique:urls,name','min:5','max:255'],
            'link' => ['required','unique:urls,link','min:14']
        ];
    }
    public function messages()
    {
        return [
            'required' => 'Поле :attribute не должно быть пустым',
            'min' => ['array' => 'The :attribute field must have at least :min items.',
                'file' => 'The :attribute field must be at least :min kilobytes.',
                'numeric' => 'The :attribute field must be at least :min.',
                'string' => 'Поле :attribute должно :min символов.',]

        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Имя',
            'link' => 'Ссылка'

        ];
    }
}
