<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SongRequest extends FormRequest
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
        $mode = $this->request->get('mode');

        $rules = [
            'title' => 'required|max:255',
            'file_name' => 'required|max:255',
        ];
        if (is_null($mode)) {
            $rules['image'] = 'required|image|mimes:jpg,png,jpeg';
        }else {
            $rules['image_hidden'] = 'required';
        }
        return $rules;
    }

    public function messages()
    {
        $mode = $this->request->get('mode');

        $message = [];
        if (!is_null($mode)) {
            $message['image_hidden.required'] = 'Image is required';
        }
        return $message;
    }
}
