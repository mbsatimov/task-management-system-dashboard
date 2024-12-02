<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class TaskPostRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:1', 'max:255'],
            'description' => ['required', 'string', 'min:1', 'max:1000'],
            'video' => ['required', 'url', 'max:1000'],
            'task_category_id' => ['required', 'integer', 'exists:task_categories,id'],
            'created_by_id' => ['required', 'integer', 'exists:users,id'],
            'updated_by_id' => ['required', 'integer', 'exists:users,id'],
        ];
    }
}
