<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'surname' => 'required|min:2',
            'birthday' => 'required',
            'phone' => 'required|int',
            'email' => 'required|email',
            'comment' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'required' => "Поле :attribute не должно быть пустым.",
            'string' => 'Поле :attribute должено быть строкой.',
            'int' => 'Поле :attribute должно быть числом.',
            'email' => 'Введите действительный :attribute.',
            'min' => [
                'string' => 'Поле :attribute должно быть не короче :min символов.',
            ]
        ];
    }

    public function attributes(): array
    {
        return [
            'first_name' => "\"Имя\"",
            "last_name" => "\"Фамилия\"",
            "surname" => "\"Отчество\"",
            "birthday" => "\"Дата рождения\"",
            "phone" => "\"Телефон\"",
            "email" => "\"Емейл\"",
            "comment" => "\"Комментарии\""
        ];
    }
}
