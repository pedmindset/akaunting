<?php

namespace App\Http\Requests\Install;

use App\Traits\SettingRequest;
use App\Abstracts\Http\FormRequest;

class Setting extends FormRequest
{
    use SettingRequest;
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
            'company_name' => 'required',
            'company_email' => 'required',
            'user_email' => 'required',
            'user_password' => 'required'
        ];
    }
}
