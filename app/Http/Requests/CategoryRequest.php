<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $id = $this->request->get('id');
        $rules = [
            'name' => 'required|unique:categories|max:255'
        ];
        if (!is_null($id)) {
            $rules['name'] = ['required', function($attribute, $value, $fail) use ($id) {
                $collections = Category::query()->where('id', '<>', $id)->where('name', trim($value))->get();
                if (count($collections) > 0) {
                    return $fail('The ' . $attribute . ' as already been taken.');
                }
            }, 'max:25'];
        }

        return $rules;
    }
}
