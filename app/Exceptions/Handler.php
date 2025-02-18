<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function report(Throwable $exception)
    {
        if (auth()->check()) {
            // Log error with user information if the user is logged in
            Log::channel('user')->error('User Error', [
                'user_id' => auth()->id(),
                'email' => auth()->user()->email,
                'error_message' => $exception->getMessage(),
                'error_line'=>$exception->getLine(),
                'error_file'=>$exception->getFile(),
                'stack_trace' => $exception->getTraceAsString(),
                // 'ip_address' => request()->ip(),
            ]);
        } else {
            // Log error without user details if not logged in
            Log::error('Error', [
                'error_message' => $exception->getMessage(),
                'stack_trace' => $exception->getTraceAsString(),
                // 'ip_address' => request()->ip(),
            ]);
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Throwable $exception)
    {
        if (!auth()->check()) {
            // If the user is not logged in, show a 404 error page
            return response()->view('backend.errors.404', [], 404);
        }

        return parent::render($request, $exception);
    }
}
