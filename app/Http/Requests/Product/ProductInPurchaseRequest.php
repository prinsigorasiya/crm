<?php

namespace App\Http\Requests\Product;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ProductInPurchaseRequest extends FormRequest
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
               "serial_no" => ['required', 'string', 'max:255', Rule::unique('products', 'serial_no')
                    ->whereNull('deleted_at')],
               "requiredment_type" => ['required', 'string', 'max:255'],
               "project_code" => ['required', 'string', 'max:255'],
               "pcb_code" => ['required', 'string', 'max:255'],
               "quantity" => ['required', 'integer'],
               "unit" => ['required', 'string', 'max:255'],
               "layer" => ['required', 'integer'],
               "pcb_thickness" => ['required', 'numeric'],
               "sku" => ['required', 'string', 'max:255'],
               "mpn" => ['required', 'string', 'max:255'],
               "suggested_vendor" => ['required', 'string', 'max:255'],
               "gerber_link" => ['required', 'string', 'max:255'],
               "target_receive_date" => ['required', 'date'],
               "request_person" => ['required', 'string', 'max:255'],
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
