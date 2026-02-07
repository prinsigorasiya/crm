<?php

namespace App\Http\Requests\ProjectTimeSheet;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ProjectTimeSheetStoreRequest extends FormRequest
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
               'project_id' => ['required', 'integer', Rule::exists('projects', 'id')
                    ->where(function ($query) {
                         $query->whereNull('deleted_at')
                              ->where('status', 'Running');
                    })],
               'start_time' => ['required', 'date_format:H:i:s'],
               'end_time' => ['required', 'date_format:H:i:s'],
               'notes' => ['nullable', 'string'],
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
