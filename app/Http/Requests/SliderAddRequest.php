<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderAddRequest extends FormRequest
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
            'description' => 'required',
            'name' => 'required|unique:sliders',
            'image_path' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên Slider không được để trống',
            'name.unique' => 'Slider đã tồn tại',
            'image_path.required' => 'Ảnh Slider chưa được chọn',
        ];
    }
}
