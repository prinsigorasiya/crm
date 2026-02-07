<?php
     
namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UserStoreRequest extends FormRequest
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
               'first_name' => ['required', 'string', 'max:255'],
               'middle_name' => ['nullable', 'string', 'max:255'],
               'last_name' => ['required', 'string', 'max:255'],
               'user_name' => ['required', 'string', 'max:255', Rule::unique('users', 'user_name')],
               'password' => ['required', 'string', 'min:8'],
               'email' => ['required', 'string', Rule::unique('users', 'email')],
               'department' => ['required', 'string', 'max:255'],
               
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
