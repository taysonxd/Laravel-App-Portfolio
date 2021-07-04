<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveProjectRequest extends FormRequest
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
            'image' => [
                $this->route('project') ? 'nullable' : 'required',
                'mimes:jpg,png'
            ],
            'category_id' => [
                'required',
                'exists:categories,id'
            ],
            'title' => 'required',
            'slug' => [
                'required',
                Rule::unique('projects')->ignore(request()->route('project'))
            ],
            'description' => 'required|min:5'
        ];
    }

    public function messages() {
        return [
            'title.required' => __('The project needs a title'),
            'slug.required' => __('The project needs a URL'),
            'slug.unique' => __('The URL cannot be duplicated'),
        ];
    }
}
