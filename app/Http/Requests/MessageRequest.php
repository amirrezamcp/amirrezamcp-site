<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class MessageRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:256'],
            'email' => ['required', 'email'],
            'message' => ['required', 'string', 'max:2000', 'min:10']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'وارد کردن نام الزامی است.',
            'name.string' => 'نام باید یک رشته متنی باشد.',
            'name.max' => 'نام نمی‌تواند بیشتر از ۲۵۶ کاراکتر باشد.',
            'name.alpha_spaces' => 'نام فقط می‌تواند شامل حروف و فضاها باشد.',
            'email.required' => 'وارد کردن ایمیل الزامی است.',
            'email.email' => 'لطفاً یک ایمیل معتبر وارد کنید.',
            'message.required' => 'وارد کردن پیام الزامی است.',
            'message.string' => 'پیام باید یک رشته متنی باشد.',
            'message.max' => 'پیام نمی‌تواند بیشتر از ۲۰۰۰ کاراکتر باشد.',
            'message.min' => 'پیام باید حداقل ۱۰ کاراکتر باشد.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'نام',
            'email' => 'ایمیل',
            'message' => 'پیام',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => 'خطا در اعتبارسنجی',
            'errors' => $validator->errors(),
        ], 422));
    }
}
