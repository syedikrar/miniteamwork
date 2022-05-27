<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskStoreRequest extends FormRequest
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
      // return "here";exit;
      return [
          'name' => 'required|string|max:50',
          'description' => 'required|string',
          'completed_flag' => 'required'
      ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Name is required!',
            'description.required' => 'Description is required!',
            'completed_flag.required' => 'Flag is required!'
        ];
    }
}
