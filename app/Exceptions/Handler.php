<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
  /*  protected $dontReport = [
        HttpException::class,
    ];
*/
    protected $dontReport = [
        'Symfony\Component\HttpKernel\Exception\HttpException'
    ];
    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    /*public function render($request, Exception $e)
    {
        return parent::render($request, $e);
    }*/
    public function render($request, Exception $e)
    {
        if ($this->isHttpException($e))
        {
            return $this->renderHttpException($e);
        }
        else if($e instanceof NotFoundHttpException)
        {
            return response()->view('errors.503', [], 404);
        }
        else
        {
            return parent::render($request, $e);
        }
    }
}
