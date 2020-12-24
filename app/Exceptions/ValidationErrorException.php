<?php

namespace App\Exceptions;

use Exception;

class ValidationErrorException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response()->json([
                    'errors' => [
                        'code' => 422,
                        'title' => 'Validation Error',
                        'detail' => 'your request is malformed or missing field',
                        'meta' => json_decode($this->getMessage()),
                    ]
            ], 422);
    }
}
