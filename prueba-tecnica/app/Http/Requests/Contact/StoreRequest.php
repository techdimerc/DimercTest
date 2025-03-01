<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;


class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize():bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'name'=>'required|min:3|max:100',
            'phone'=>'required|min:9|max:50',
            'avatar'=>'nullable|mimes:png,jpg,jpeg|max:2040',
            'privacity'=>'required|in:public,private'
        ];
    }
}
