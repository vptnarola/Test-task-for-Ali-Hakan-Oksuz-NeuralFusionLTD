<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAdsenseRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $array = [];
        if ( $this->banner_image != 'undefined' ) {
            $banner_image = !$this->adsense_id ? 'required' : 'sometimes';

            $array = [
                'banner_image' => [$banner_image, 'image'],
            ];
        }

        return [
            'adsense_id' => ['sometimes', 'required'],
            'name' => ['required', 'string'],
            'url' => ['required', 'string', 'active_url'],
            // 'position' => ['required'],
            'status' => ['sometimes', 'required'],
            'banner_width' => ['bail', 'sometimes', 'required', 'numeric'],
            'banner_height' => ['bail', 'sometimes', 'required', 'numeric'],
        ] + $array;
    }
}
