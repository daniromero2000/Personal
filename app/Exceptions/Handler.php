<?php

namespace App\Exceptions;

use App\Traits\ApiResponse;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{

    use ApiResponse;
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
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        // dd($exception);

        if (env('APP_ENV') == 'local') {
            //return parent::render($request, $exception);
        }

        if ($exception instanceof NotFoundHttpException) {
            return $this->errorResponse("Página no encontrada", $code = 404, $msj = 'Página no encontrada');
        }

        if ($exception instanceof ModelNotFoundException) {
            return $this->errorResponse("Recurso no encontrado", $code = 404, $msj = 'Recurso no encontrado');
        }

        return parent::render($request, $exception);
    }
}
