<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
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
            'file' => 'required',
            'matter' => 'required',
            'type' => 'required',
            'user_id' => 'required',
        ];
    }

    public function messages(){
      return [
        'file.required' => 'ファイルを選択してください。',
        'matter.required' => '選択してください。',
        'type.required' => '選択してください。',
        'user_id.required' => '必須項目です。',
      ];
    }
}
