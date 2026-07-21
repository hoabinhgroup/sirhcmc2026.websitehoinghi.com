<?php

namespace App\Http\Requests;

use App\Rules\ValidRecaptcha;
use App\Services\FeeCalculationService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class RegistrationSubmitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function isInternational(): bool
    {
        return $this->input('scope') === 'international';
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $feeSlugs = collect(config('registration.fees', []))
            ->reject(fn (array $fee): bool => (bool) ($fee['hidden'] ?? false))
            ->keys()
            ->all();
        $scope = $this->isInternational() ? 'international' : 'domestic';
        $uploadMimes = config('registration.upload.mimes', ['pdf', 'jpg', 'jpeg', 'png']);
        $uploadMax = (int) config('registration.upload.max_kb', 10240);

        $rules = [
            'scope' => ['required', 'in:domestic,international'],
            'title' => ['required', 'string', Rule::in(array_keys(config("registration.titles.{$scope}")))],
            'titleOther' => ['nullable', 'string', 'max:100', 'required_if:title,other'],
            'fullname' => ['required', 'string', 'max:250'],
            'affiliation' => ['required', 'string', 'max:300'],
            'position' => ['nullable', 'string', 'max:250'],
            'day' => ['required', 'integer', 'between:1,31'],
            'month' => ['required', 'integer', 'between:1,12'],
            'year' => ['required', 'integer', 'min:1940', 'max:'.date('Y')],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:150'],
            'degree_file' => ['required', 'file', 'mimes:'.implode(',', $uploadMimes), "max:{$uploadMax}"],
            'dietary' => ['nullable', 'string', Rule::in(array_keys(config("registration.dietary_options.{$scope}")))],
            'dietaryOther' => ['nullable', 'string', 'max:300', 'required_if:dietary,other'],
            'conference_checklist_item' => ['required', 'string', Rule::in($feeSlugs)],
            'galadinner_fee' => ['nullable', 'boolean'],
            'total_amount' => ['nullable', 'numeric', 'min:0'],
            'payment_method' => ['nullable', 'in:onepay,bank-transfer'],
        ];

        if ($this->isInternational()) {
            $rules['country'] = ['required', 'string', 'max:120'];
        } else {
            $rules['country'] = ['nullable', 'string', 'max:120'];
        }

        if (! $this->isInternational() && config('services.recaptcha.secret_key')) {
            $rules['g-recaptcha-response'] = ['required', new ValidRecaptcha];
        }

        return $rules;
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            if ($validator->errors()->isNotEmpty()) {
                return;
            }

            $feeCalc = app(FeeCalculationService::class);
            $fees = $feeCalc->calculate(
                (string) $this->input('conference_checklist_item'),
                $this->boolean('galadinner_fee'),
                $this->input('payment_method'),
            );

            if ($fees['total'] > 0 && ! $this->input('payment_method')) {
                $validator->errors()->add(
                    'payment_method',
                    $this->isInternational()
                        ? 'Please select a payment method.'
                        : 'Vui lòng chọn phương thức thanh toán.',
                );
            }
        });
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        if ($this->isInternational()) {
            return [
                'title.required' => 'Please select a title.',
                'fullname.required' => 'Please enter your full name.',
                'affiliation.required' => 'Please enter your affiliation.',
                'country.required' => 'Please enter your country/region.',
                'degree_file.required' => 'Please upload your degree/certificate file.',
                'conference_checklist_item.required' => 'Please select a conference type.',
                'payment_method.required' => 'Please select a payment method.',
                'g-recaptcha-response.required' => 'Please complete the reCAPTCHA verification.',
            ];
        }

        return [
            'title.required' => 'Vui lòng chọn danh xưng.',
            'fullname.required' => 'Vui lòng nhập họ tên.',
            'affiliation.required' => 'Vui lòng nhập đơn vị công tác.',
            'degree_file.required' => 'Vui lòng tải lên bằng cấp / chứng chỉ.',
            'conference_checklist_item.required' => 'Vui lòng chọn loại đại biểu/phí.',
            'payment_method.required' => 'Vui lòng chọn phương thức thanh toán.',
            'g-recaptcha-response.required' => 'Vui lòng xác minh reCAPTCHA.',
        ];
    }
}
