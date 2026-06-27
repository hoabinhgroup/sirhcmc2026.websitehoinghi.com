<?php

namespace App\Http\Requests;

use App\Rules\ValidRecaptcha;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AbstractSubmissionSubmitRequest extends FormRequest
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
        $scope = $this->isInternational() ? 'international' : 'domestic';
        $categories = array_keys(config('abstract.categories', []));
        $uploadMimes = config('abstract.upload.mimes', ['pdf', 'jpg', 'jpeg', 'png', 'doc', 'docx']);
        $imageMimes = config('abstract.upload.image_mimes', ['jpg', 'jpeg', 'png']);
        $uploadMax = (int) config('abstract.upload.max_kb', 10240);

        $rules = [
            'scope' => ['required', 'in:domestic,international'],
            'abstract_category' => ['required', 'string', Rule::in($categories)],
            'title' => ['required', 'string', Rule::in(array_keys(config("abstract.titles.{$scope}")))],
            'titleOther' => ['nullable', 'string', 'max:100', 'required_if:title,other'],
            'fullname' => ['required', 'string', 'max:250'],
            'affiliation' => ['required', 'string', 'max:300'],
            'position' => ['nullable', 'string', 'max:250'],
            'day' => ['required', 'integer', 'between:1,31'],
            'month' => ['required', 'integer', 'between:1,12'],
            'year' => ['required', 'integer', 'min:1940', 'max:'.date('Y')],
            'phone' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'max:150'],
            'abstract_file' => ['required', 'file', 'mimes:'.implode(',', $uploadMimes), "max:{$uploadMax}"],
            'cv_file' => ['required', 'file', 'mimes:'.implode(',', $uploadMimes), "max:{$uploadMax}"],
            'headshot_file' => ['required', 'file', 'mimes:'.implode(',', $imageMimes), "max:{$uploadMax}"],
            'dietary' => ['nullable', 'string', Rule::in(array_keys(config("abstract.dietary_options.{$scope}")))],
            'dietaryOther' => ['nullable', 'string', 'max:300', 'required_if:dietary,other'],
        ];

        if ($this->isInternational()) {
            $rules['country'] = ['required', 'string', 'max:120'];
        } else {
            $rules['country'] = ['nullable', 'string', 'max:120'];
            $rules['citizen_id'] = ['required', 'string', 'regex:/^\d{12}$/'];
            $rules['degree_file'] = ['required', 'file', 'mimes:'.implode(',', $uploadMimes), "max:{$uploadMax}"];
        }

        if (! $this->isInternational() && config('services.recaptcha.secret_key')) {
            $rules['g-recaptcha-response'] = ['required', new ValidRecaptcha];
        }

        return $rules;
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        if ($this->isInternational()) {
            return [
                'abstract_category.required' => 'Please select an abstract category.',
                'title.required' => 'Please select a title.',
                'fullname.required' => 'Please enter your full name.',
                'affiliation.required' => 'Please enter your affiliation.',
                'country.required' => 'Please enter your country/region.',
                'email.required' => 'Please enter your email address.',
                'abstract_file.required' => 'Please upload your abstract file.',
                'cv_file.required' => 'Please upload your CV.',
                'headshot_file.required' => 'Please upload your headshot photo.',
                'g-recaptcha-response.required' => 'Please complete the reCAPTCHA verification.',
            ];
        }

        return [
            'abstract_category.required' => 'Vui lòng chọn chủ đề.',
            'title.required' => 'Vui lòng chọn danh xưng.',
            'fullname.required' => 'Vui lòng nhập họ tên.',
            'affiliation.required' => 'Vui lòng nhập đơn vị công tác.',
            'citizen_id.required' => 'Vui lòng nhập số Căn cước công dân.',
            'citizen_id.regex' => 'Số CCCD phải gồm 12 chữ số.',
            'email.required' => 'Vui lòng nhập email.',
            'abstract_file.required' => 'Vui lòng tải lên bài báo cáo tóm tắt.',
            'cv_file.required' => 'Vui lòng tải lên CV.',
            'headshot_file.required' => 'Vui lòng tải lên ảnh chân dung.',
            'degree_file.required' => 'Vui lòng tải lên bằng cấp.',
            'g-recaptcha-response.required' => 'Vui lòng xác minh reCAPTCHA.',
        ];
    }
}
