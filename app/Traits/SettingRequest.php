<?php

namespace App\Traits;


trait SettingRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        session(['locale' => 'en_GB']);
        
        return [
            'company_name' => 'required',
            'company_email' => 'required',
            'user_email' => 'required',
            'user_password' => 'required',
            'role' => 'required',
            'currency' => 'required',
        ];
    }

}
