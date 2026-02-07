<?php

namespace App\Http\Requests\Product;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ProductOrderRequest extends FormRequest
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
      */
     public function rules(): array
     {
          return [
               "serial_no" => ['required', 'string', 'max:255', Rule::exists('products', 'serial_no')
                    ->where(function ($query) {
                         $query->whereNull('deleted_at');
                    })],
               "order_qty" => ['required', 'integer', 'min:1'],
               "price_per_piece" => ['required', 'numeric', 'min:0'],
               "order_vendor" => ['required', 'string', 'max:255'],
               "sku" => ['required', 'string', 'max:255'],
               "mpn" => ['required', 'string', 'max:255'],
               "order_person" => ['required', 'string', 'max:255'],
               "order_date" => ['required', 'date'],
               "expected_date" => ['required', 'date', 'after_or_equal:order_date'],
               "target_receive_date" => ['required', 'date', 'after_or_equal:order_date'],
          ];
     }


     protected function failedValidation(Validator $validator)
     {
          throw new HttpResponseException(
               sendJsonResponse([
                    'status_code' => 400,
                    'message' => $validator->errors()->first(),
               ])
          );
     }
}
