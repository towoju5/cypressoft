<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
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
    protected $dontFlash = ['current_password', 'password', 'password_confirmation'];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        // $this->renderable(function (Throwable $e, $request) {
        //     if(request()->expectsJson()){
        //         $result = $e->getMessage();
        //         return response()->json(
        //             [
        //                 'status' => 'error',
        //                 'code' => $e->getCode(),
        //                 'message' => "Oops we've hit a snag.",
        //                 'data' => [
        //                     'error' => $request,
        //                 ],
        //             ],
        //         );
        //     }
        // });

        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
