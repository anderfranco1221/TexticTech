<?php

namespace App\Exceptions\JsonApi;

use Exception;
use Illuminate\Http\Response;

class AuthenticationException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function render($request)
    {

        $data = [
            'errors' => [
                'title' => 'Unauthenticated',
                'detail' => 'This action requires authentication.',
                'status' => '401',
            ]
        ];

        return response()->json($data, 401);
    }
}
