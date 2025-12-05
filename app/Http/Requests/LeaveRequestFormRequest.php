<?php

namespace App\Http\Requests;

use App\Enums\LeaveType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LeaveRequestFormRequest extends FormRequest
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
            'leave_type' => [
                'required',
                'string',
                Rule::enum(LeaveType::class),
            ],
            'start_date' => [
                'required',
                'date',
                'after_or_equal:today',
            ],
            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
            ],
            'employee_notes' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'attachment' => [
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png,doc,docx',
                'max:5120', // 5MB max
            ],
        ];
    }

    /**
     * Get custom attribute names for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'leave_type' => 'leave type',
            'start_date' => 'start date',
            'end_date' => 'end date',
            'employee_notes' => 'notes',
            'attachment' => 'attachment',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'leave_type.Illuminate\Validation\Rules\Enum' => 'Please select a valid leave type.',
            'start_date.after_or_equal' => 'Start date cannot be in the past.',
            'end_date.after_or_equal' => 'End date must be on or after the start date.',
            'attachment.mimes' => 'Attachment must be a PDF, JPG, PNG, or Word document.',
            'attachment.max' => 'Attachment must not exceed 5MB.',
        ];
    }
}
