<?php

namespace Marcohern\Products\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
          'name'        => 'required|string|max:128',
          'slug'        => 'string|max:128|unique',
          'overview'    => 'required|string|max:65536',
          'description' => 'required|string|max:65536',
          'org_price'   => 'required|numeric',
          'dct_price'   => 'numeric|min:0',
          'qty'         => 'integer|min:0',

          'visible'   => 'boolean',
          'hot'       => 'boolean',
          'hot_until' => 'date',
          'featured'  => 'boolean',
          'parent_id' => 'integer',

          'hits' => 'integer|min:0',
          'clicks' => 'integer|min:0',
          'sales_count' => 'integer|min:0',
          'sales_value' => 'numeric|min:0',
          'rating_count' => 'integer|min:0',
          'rating_value' => 'numeric|min:0',
        ];
    }
}
