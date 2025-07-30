<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'first_name.required' => __('validation.required', ['attribute' => __('first_name')]),
            'first_name.string' => __('validation.string', ['attribute' => __('first_name')]),
            'first_name.max' => __('validation.max.string', ['attribute' => __('first_name'), 'max' => 255]),
            
            'last_name.required' => __('validation.required', ['attribute' => __('last_name')]),
            'last_name.string' => __('validation.string', ['attribute' => __('last_name')]),
            'last_name.max' => __('validation.max.string', ['attribute' => __('last_name'), 'max' => 255]),
            
            'email.required' => __('validation.required', ['attribute' => __('email')]),
            'email.email' => __('validation.email', ['attribute' => __('email')]),
            'email.max' => __('validation.max.string', ['attribute' => __('email'), 'max' => 255]),
            
            'subject.required' => __('validation.required', ['attribute' => __('subject')]),
            'subject.string' => __('validation.string', ['attribute' => __('subject')]),
            'subject.max' => __('validation.max.string', ['attribute' => __('subject'), 'max' => 255]),
            
            'message.required' => __('validation.required', ['attribute' => __('message')]),
            'message.string' => __('validation.string', ['attribute' => __('message')]),
            'message.max' => __('validation.max.string', ['attribute' => __('message'), 'max' => 5000]),
        ];
    }
}
