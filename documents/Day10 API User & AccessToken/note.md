<!------------------- API Result ------------------>

-------------------------
try {
    return response()->json([
        'status'    => true,
        'code'  => Response::HTTP_OK
    ]);
} catch (\Exception $e) {
    return response()->json([
        'errors'    => [
            'status'    => false,
            'code'      => Response::HTTP_INTERNAL_SERVER_ERROR,
            'message'   => $e->getMessage(),
        ]
    ]);
}
-------------------------

Laravel Tinker Server to Debug Code
https://github.com/beyondcode/laravel-tinker-server

hoặc 

Laravel Debugbar
https://github.com/barryvdh/laravel-debugbar

-------------------------

--Result:
    * URL: 
    * Method: 
    * Request:
    * Response: