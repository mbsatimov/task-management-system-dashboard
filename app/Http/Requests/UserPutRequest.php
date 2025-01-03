<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UserPutRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'min:3', 'max:255'],
            'roles' => ['required'],
            'student_number' => ['required_if:roles,student', 'unique:users,student_number'.($this->route('user') ? ','.$this->route('user')->id : ''), 'string', 'min:1', 'max:255'],
            'category_id' => ['required_if:roles,mentor', 'exists:task_categories,id'],
            'password' => ['nullable', 'min:8', 'max:20'],
        ];
    }
}
