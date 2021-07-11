<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonFormRequest extends FormRequest
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
            'name' => 'required|regex:/^[a-zA-Z ]+$/i',
            'height' => 'nullable|numeric',
            'mass' => 'nullable|numeric',
            'hair_color' => 'nullable|regex:/^[a-zA-Z \/]+$/i',
            'birth_year' => 'required|alpha_num',
            'url' => 'nullable|url',
            'gender_id' => 'required|exists:genders,id',
            'homeworld_id' => 'required|exists:homeworlds,id',
            'films' => 'nullable|array',
            'films.*' => 'exists:films,id',
            'images' => 'nullable|array',
            'images.*' => 'file|image',
            'imagesToDelete' => 'nullable|array',
            'imagesToDelete.*' => 'exists:images,id',
        ];
    }

    public function attributes()
    {
        return [
            'images.*' => 'Uploading image(s)',
            'imagesToDelete.*' => 'Checked image(s)',
        ];
    }

    public function passedValidation()
    {
        /* Set default values */
        $this->merge([
            'height' => $this['height'] ?? 'unknown',
            'mass' => $this['mass'] ?? 'unknown',
            'hair_color' => $this['hair_color'] ?? 'n/a',
            'url' => $this['url'] ?? 'unknown',
        ]);
    }
}
