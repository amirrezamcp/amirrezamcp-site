<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'bio' => ['required', 'string'],
            'skills' => ['nullable', 'array'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'وارد کردن نام الزامی است.',
            'name.string' => 'نام باید یک رشته متنی باشد.',
            'bio.required' => 'وارد کردن بیو الزامی است.',
            'bio.string' => 'بیو باید یک رشته متنی باشد.',
            'skills.array' => 'مهارت‌ها باید به صورت آرایه‌ای ارسال شوند.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'نام',
            'bio' => 'بیو',
            'skills' => 'مهارت‌ها',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => false,
            'message' => 'خطا در اعتبارسنجی',
            'errors' => $validator->errors()
        ], 422));
    }
}
