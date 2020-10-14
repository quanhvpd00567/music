<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MasterCategoryRequest extends FormRequest
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
            'category_clone' => 'required|max:255',
            'category_id' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'category_clone' => 'Category clone',
            'category_id' => 'Category display',
        ];
    }

}
