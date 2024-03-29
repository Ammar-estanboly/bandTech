<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use  Illuminate\Validation\ValidationException;
use Throwable;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];


    protected function invalidJson($request, ValidationException $exception)
    {

        $errors = $exception->errors();
        $errors = array_reverse($errors);
        $errors = array_pop($errors);
        $response = [
            "success" => false,
            "data"    => [],
            "message" =>$errors[0],
            "status_code"=>$exception->status,
            "errors"=>[$exception->errors()]
        ];

        return response()->json($response);

      }





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


        $this->renderable(function (NotFoundHttpException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    "success" => false,
                    "data"    => [],
                    "message" =>'error',
                    "status_code"=>404,
                    "errors"=>['recorde not found']
                ], 404);
            }
        });



    }
}
