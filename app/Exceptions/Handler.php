<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
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
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if ($request->route()->getPrefix() === 'api') {
            $statusCode = $exception->getCode();

            if ($exception instanceof ModelNotFoundException) {
                $statusCode = 404;
            }

            if ($statusCode === 0) {
                $statusCode = 500;
            }

            $data = [
                'errors' => [
                    [
                        'status' => $statusCode,
                        'code' => $statusCode,
                        'title' => $exception->getMessage(),
                    ]
                ]
            ];

            return response()->json($data, $statusCode);
        }

        return parent::render($request, $exception);
    }
}
