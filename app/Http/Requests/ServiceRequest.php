<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'image' => ['nullable', 'string'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['string', 'max:50'],
            'link' => ['nullable', 'string', 'url'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'وارد کردن عنوان الزامی است.',
            'title.string' => 'عنوان باید یک رشته متنی باشد.',
            'title.max' => 'عنوان نمی‌تواند بیشتر از 255 کاراکتر باشد.',
            'description.required' => 'وارد کردن توضیحات الزامی است.',
            'description.string' => 'توضیحات باید یک رشته متنی باشد.',
            'image.string' => 'تصویر باید یک رشته متنی باشد.',
            'tags.array' => 'برچسب‌ها باید به صورت آرایه‌ای ارسال شوند.',
            'tags.*.string' => 'هر برچسب باید یک رشته متنی باشد.',
            'tags.*.max' => 'هر برچسب نمی‌تواند بیشتر از 50 کاراکتر باشد.',
            'link.string' => 'لینک باید یک رشته متنی باشد.',
            'link.url' => 'لینک باید یک URL معتبر باشد.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'عنوان',
            'description' => 'توضیحات',
            'image' => 'تصویر',
            'tags' => 'برچسب‌ها',
            'link' => 'لینک',
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
