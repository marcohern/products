<?php

namespace Marcohern\Products\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RateRequest extends FormRequest
{
    public function authorize()
    {
      return true;
    }
    
    public function rules()
    {
      return [
        'value' => 'required|numeric',
        'comments' => 'string|max:255'
      ];
    }
}
