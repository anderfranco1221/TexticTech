<?php
namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class JsonApiValidationErrorResponse extends JsonResponse
{

    public function __construct(ValidationException $exception, $status = 422) {
        $title = $exception->getMessage();

        $data = [
            'errors' => collect($exception->errors())->map(function($message, $field) use ($title){
                return [
                    'title' => $title,
                    'detail' => $message[0],
                    'source' => [
                        'pointer' => "/".str_replace('.', '/', $field),
                    ]
                ];
            })->values()
        ];

        $headers = [
            'content-type' => 'application/vnd.api+json'
        ];

        parent::__construct($data, $status, $headers);
    }
}
