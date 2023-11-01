<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {   
        // dd(hiii);
        return [
            'name' => 'required|unique:categories,name,'.$this->id,
            //'name' => 'required|unique:categories,name',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
            // 'country' => 'required',
            // 'state' => 'required',
            // 'city' => 'required',
            //'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'data' => 'required|mimes:pdf,xlx,csv,xlsx|max:2048'
            
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required!',
            'address.required' => 'Address is required!',
            'phone.required' => 'Phone is required!',
            'country.required' => 'Country is required!',
            'state.required' => 'State is required!',
            'city.required' => 'City is required!',
            //'image.required' => 'Image is required!',
            'data.required' => 'Data is required!',
        ];
    }
}
