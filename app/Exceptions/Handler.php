<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Google\Cloud\Core\Exception\ConflictException;
use Google\Cloud\Core\Exception\NotFoundException;
use Illuminate\Validation\ValidationException;
use App\Traits\Api\ApiResponder;

class Handler extends ExceptionHandler
{
    use ApiResponder;
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->renderable(function (ConflictException $e, $request) {
            $message = json_decode($e->getMessage(), true);
            return $this->errorResponse($message['error']['message'], $message['error']['code']);
        });

        $this->renderable(function (NotFoundException $e, $request) {
            $message = json_decode($e->getMessage(), true);
            return $this->errorResponse($message['error']['message'], $message['error']['code']);
        });

        $this->renderable(function (ValidationException $e, $request) {
            return $this->convertValidationExceptionToResponse($e, $request);
        });
    }

    public function convertValidationExceptionToResponse($e, $request) {
        $errors = $e->validator->errors()->getMessages();

        if ($this->isFrontend($request)) {
            return $request->ajax() ? response()->json($error, 422) : redirect()->back()
                ->withInput($request->input())
                ->withErrors($errors);
        }
        return $this->errorResponse($errors, 422);
    }

    private function isFrontend($request)
    {
        return $request->acceptsHtml() && collect($request->route()->middleware())->contains('web');
    }
}
