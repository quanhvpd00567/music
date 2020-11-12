<?php

namespace App\Http\Requests;

use App\Rules\ExcelRule;
use Illuminate\Foundation\Http\FormRequest;

class ImportSongRequest extends FormRequest
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
            'song_file' => ['required', new ExcelRule($this->file('song_file'))]
        ];
    }
}
