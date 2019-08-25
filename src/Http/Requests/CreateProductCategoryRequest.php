<?php

namespace Marcohern\Products\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductCategoryRequest extends FormRequest
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
        'name'        => 'string|required|max:112',
        'slug'        => 'string|max:128|unique',
        'type'        => 'string|max:32',
        'parent_id'   => 'integer|min:0',
        'ord'         => 'integer',
        'lvl'         => 'integer|min:0',
        'description' => 'string|max:65536',

        'hits'          => 'integer|min:0',
        'clicks'        => 'integer|min:0',
        'sales_count'   => 'integer|min:0',
        'sales_value'   => 'numeric|min:0',
      ];
    }
}
