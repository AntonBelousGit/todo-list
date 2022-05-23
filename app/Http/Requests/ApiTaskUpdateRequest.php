<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApiTaskUpdateRequest extends FormRequest
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
            'title' => 'required|string',
            'description' => 'required|string',
            'priority' => 'required|in:1,2,3,4,5',
            'status' => 'filled|in:todo,done',
//            'todo_list_id' => 'nullable|exclude_unless:task_id,null',
            'task_id' => 'filled'
        ];
    }
}
