<?php

namespace App\Exceptions;

use App\Exceptions\JsonApi\AuthenticationException;
use Throwable;
use Illuminate\Validation\ValidationException;
use App\Http\Responses\JsonApiValidationErrorResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->renderable(fn (NotFoundHttpException $e) => throw new JsonApi\NotFoundHttpException);
        $this->renderable(fn (BadRequestHttpException $e)=> throw new JsonApi\BadRequestHttpException($e->getMessage()));
        $this->renderable(fn (AuthenticationException $e) => throw new JsonApi\AuthenticationException );
    }

    protected function invalidJson($request, ValidationException $exception ){

        if ($request->isJsonApi()) {
            return new JsonApiValidationErrorResponse($exception);
        }

        return parent::invalidJson($request, $exception);
    }
}
