<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Throwable;


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
        $this->renderable(function (\Exception $e) {
            // return $e->getCode();
            // if ($e->getPrevious() instanceof \Illuminate\Session\TokenMismatchException) {
            //     return redirect()->route('login');
            // }
            // else if ($e->getCode() == '419') {
            //     return redirect()->route('login')->with('error', 'Error 419: Token mismatch. Please try again.');
            // }
            // else if ($e->getCode() == '404') {
            //     return redirect()->route('login')->with('error', 'Error 404: Page not found.');
            // }
            // else if ($e->getCode() == '500') {
            //     return redirect()->route('login')->with('error', 'Error 500: Internal Server Error.');
            // }
            // else if ($e->getCode() == '503') {
            //     return redirect()->route('login')->with('error', 'Error 503: Service Unavailable.');
            // }
            // return redirect()->route('login');
        });
    }

    public function render($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException) {
            flash()->addError('Error 404: Page not found.');
            return redirect()->route('home');
        }
        else if ($exception instanceof TokenMismatchException) {
            flash()->addError('Error: Token mismatch. Please try again.');
            return redirect()->route('home');
        }
        else if ($exception instanceof HttpException && $exception->getStatusCode() == 500) {
            flash()->addError('Error 500: Internal Server Error.');
            return redirect()->route('home');
        }
        if ($exception instanceof ServiceUnavailableHttpException && $exception->getStatusCode() == 503) {
            flash()->addError('Error 503: Service Unavailable.');
            return redirect()->route('home');
        }
        else{
            return parent::render($request, $exception);
        }

    }

}
