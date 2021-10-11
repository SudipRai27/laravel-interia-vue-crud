<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'email' => [
                'required',
                Rule::unique('employees')->ignore($this->employee->id)
            ],
            'phone' => [
                'required',
                'regex:/(^[0-9]+$)+/',
                'digits:10'
            ],
            'department_id' => ['required', 'exists:departments,id']
        ];
    }
}