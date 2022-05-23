<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiFilterRequest extends FormRequest
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
            'status' => 'string|in:todo,done',
            'priority' => 'integer|in:1,2,3,4,5',
            'title' => 'string',
            'priority_between' => 'array',
            'priority_at' => 'string|in:desc,asc',
            'created_at' => 'string|in:desc,asc',
            'completed_at' => 'string|in:desc,asc',
            'without' => 'string|in:subtask',
        ];
    }
}
