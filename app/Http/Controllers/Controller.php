<?php

namespace App\Http\Controllers;

abstract class Controller
{
    /**
     * Return success JSON response.
     */
    protected function success($data = null, string $message = 'Success', int $code = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Return error JSON response.
     */
    protected function error(string $message = 'Error', int $code = 400, $data = null)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * Return validation error response.
     */
    protected function validationError($errors, string $message = 'Validation Error')
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors
        ], 422);
    }

    /**
     * Return not found response.
     */
    protected function notFound(string $message = 'Resource not found')
    {
        return response()->json([
            'success' => false,
            'message' => $message
        ], 404);
    }
}