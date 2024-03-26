<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator): void
    {
        $validators = $validator->errors()->toArray();
        $errors = [];
        foreach ($validators as $key => $value) {
            $errors[$key] = $value[0];
        }
        $message = [
            "messageId"  => "E422",
            "message"     => trans('messages.validate_errors'),
            "errors"      => $errors,
        ];

        throw new HttpResponseException(response()->json($message, Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
