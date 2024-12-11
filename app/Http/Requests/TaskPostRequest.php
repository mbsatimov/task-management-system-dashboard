<?php

namespace App\Http\Requests;

use App\Models\User;
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
            'title' => ['required', 'string', 'min:1', 'max:255'],
            'description' => ['required', 'string', 'min:1', 'max:1000'],
            'video' => ['required', 'url', 'max:1000'],
            'deadline' => ['required', 'date', 'after:now'],
            'category_id' => ['required', 'integer', 'exists:task_categories,id'],
            'mentor_id' => ['required', 'integer', function ($attribute, $value, $fail) {
                $user = User::find($value);
                if (!$user->hasRole('mentor')) {
                    $fail('The ' . $attribute . ' must have the mentor role.');
                }
            }],
            'student_ids' => ['required', 'array', 'min:1', function ($attribute, $value, $fail) {
                foreach ($value as $student_id) {
                    $user = User::find($student_id);
                    if (!$user->hasRole('student')) {
                        $fail('The ' . $attribute . ' must have the student role.');
                    }
                }
            }],
        ];
    }
}
