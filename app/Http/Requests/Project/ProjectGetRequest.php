<?php

namespace App\Http\Requests\Project;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ProjectGetRequest extends FormRequest
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
               'id' => ['required', 'integer', Rule::exists('projects', 'id')
                    ->where(function ($query) {
                         $query->whereNull('deleted_at');
                    })],
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
