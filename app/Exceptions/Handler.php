<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
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
        'current_password',
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
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param \Exception $exception
     *
     * @return \Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Throwable $exception)
    {
        switch (get_class($exception)) {
            case "Illuminate\\Database\\QueryException":
                return response(['message' => 'Um erro ocorreu. Contate o suporte.'], 500);
                break;
            case "Symfony\\Component\\ErrorHandler\\Error\\FatalError":
                return response(['message' => 'Um erro ocorreu. Contate o suporte.'], 500);
                break;
            case "Illuminate\\Validation\\ValidationException":
                return response(['message' => $exception->validator->messages()], 422);
                break;
            case "Symfony\\Component\\Routing\\Exception\\RouteNotFoundException":
                return response(['message' => 'Rota não encontrada ou Token não reconhecido.'], 404);
                break;
        }
    }
}
