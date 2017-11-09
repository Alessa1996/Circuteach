<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
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
      if($this->isHttpException($exception))
        {
            switch ($exception->getStatusCode())
                {
                // not found
                case "404":
                if ($request->ajax()) {
                    return response()->json(['mensaje' => 'No se encuentra la ruta de destino', 'tipo' => 'error'], 404);
                }
                $request->session()->flash('alert-danger',"la página a la que desea acceder no se encuentra");
                return redirect()->guest('home');
                break;

                // internal error
                case '500':
                if ($request->ajax()) {
                    return response()->json(['error' => 'Error interno del servidor', 'tipo' => 'error'], 500);
                }
                $request->session()->flash('alert-danger',"Error interno del servidor");
                return redirect()->guest('home');
                break;

                default:
                    return $this->renderHttpException($exception);
                break;
            }
        }
        else
        {
              return parent::render($request, $exception);
        }


    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
