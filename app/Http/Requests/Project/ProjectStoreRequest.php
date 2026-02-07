<?php
     
namespace App\Http\Requests\Project;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ProjectStoreRequest extends FormRequest
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
              'name' => ['required', 'string', 'max:255'],
              'code' => ['required', 'string', 'max:255'],
              'status' => ['required', 'string', Rule::in(['InPlanning', 'Running', 'Stopped', 'Completed'])],
              'total_hours' => ['required', 'integer', 'min:0'],
              'per_day_hours' => ['required', 'integer', 'min:0'],
              'assigned_user' => ['required', 'string'],
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
