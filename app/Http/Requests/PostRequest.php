<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        
        return [
            'Name' => 'required|string|max:255',
            'Description' => 'required|string',
            'Image_path' => 'required|file|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
            
        
    }
    public function messages(): array
    {
        return [
            'Name.required' => 'The name field is required.',
            'Description.required' => 'The Description field is required.',
           'Image_path.required' => 'The Image_path field is required.',
       
           
        ];
        
    }
    
}
