<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadSongRequest extends FormRequest
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
        dd(ini_get('post_max_size'));
        return [
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'keyword' => 'max:255',
            'image' => 'required|image|mimes:jpg,png,jpeg|max:4000',
            'file' => 'required|min:5120',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Tên bài hát',
            'author' => 'Người trình bày',
            'image' => 'Hình ảnh',
            'keyword' => 'Thẻ tag',
            'file' => 'File nhạc',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => ':attribute không để trống',
            'title.max' => ':attribute không quá :max ký tự',
            'author.required' => ':attribute không để trống',
            'author.max' => ':attribute không quá :max ký tự',
            'keyword.max' => ':attribute không quá :max ký tự',
            'image.required' => ':attribute không để trống',
            'image.max' => ':attribute không quá 3M',
            'image.mimes' => ':attribute không đúng định dạng',
            'file.required' => ':attribute không để trống',
            'file.mimes' => ':attribute không đúng định dạng audio',
            'file.min' => ':attribute phải lớn hơn 5M',
        ];
    }
}
