<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatterRequest extends FormRequest
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
            'name' => 'required',
            'rank' => 'required',
            'user_id' => 'required',
        ];
    }

    public function messages(){
      return [
        'name.required' => '必須項目です。',
        'rank.required' => '必須項目です。',
        'user_id.required' => '必須項目です。',
      ];
    }
}
