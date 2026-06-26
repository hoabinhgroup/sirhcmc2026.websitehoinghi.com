<?php

namespace App\Http\Requests;

use App\Rules\ValidRecaptcha;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegistrationSubmitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $feeSlugs = array_keys(config('registration.fees', []));
        $requiresProof = $this->requiresYoungIrProof();

        $rules = [
            'title' => ['required', 'string', Rule::in(array_keys(config('registration.titles')))],
            'titleOther' => ['nullable', 'string', 'max:100', 'required_if:title,other'],
            'fullname' => ['required', 'string', 'max:250'],
            'affiliation' => ['required', 'string', 'max:300'],
            'position' => ['nullable', 'string', 'max:250'],
            'day' => ['required', 'integer', 'between:1,31'],
            'month' => ['required', 'integer', 'between:1,12'],
            'year' => ['required', 'integer', 'min:1940', 'max:'.date('Y')],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:150'],
            'degree_file' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:5120'],
            'dietary' => ['required', 'string', Rule::in(array_keys(config('registration.dietary_options')))],
            'dietaryOther' => ['nullable', 'string', 'max:300', 'required_if:dietary,other'],
            'conference_checklist_item' => ['required', 'string', Rule::in($feeSlugs)],
            'galadinner_fee' => ['nullable', 'boolean'],
            'total_amount' => ['required', 'numeric', 'min:0'],
            'payment_method' => ['required', 'in:onepay,bank-transfer'],
            'category' => ['required', 'string'],
            'country' => ['required', 'string', 'max:120'],
            'young_ir_proof_early' => [
                Rule::requiredIf($requiresProof),
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:5120',
            ],
        ];

        if ($this->input('category') === 'LOCAL REGISTRATION' && config('services.recaptcha.secret_key')) {
            $rules['g-recaptcha-response'] = ['required', new ValidRecaptcha];
        }

        return $rules;
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Vui lòng chọn danh xưng.',
            'fullname.required' => 'Vui lòng nhập họ tên.',
            'affiliation.required' => 'Vui lòng nhập đơn vị công tác.',
            'degree_file.required' => 'Vui lòng tải lên bằng cấp / chứng chỉ.',
            'conference_checklist_item.required' => 'Vui lòng chọn gói phí tham dự.',
            'payment_method.required' => 'Vui lòng chọn phương thức thanh toán.',
            'young_ir_proof_early.required' => 'Vui lòng tải lên giấy tờ xác nhận bác sĩ trẻ.',
            'g-recaptcha-response.required' => 'Vui lòng xác minh reCAPTCHA.',
        ];
    }

    private function requiresYoungIrProof(): bool
    {
        $slug = (string) $this->input('conference_checklist_item');

        return (bool) data_get(config("registration.fees.{$slug}"), 'requires_proof', false);
    }
}
