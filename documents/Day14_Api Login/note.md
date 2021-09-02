<!------------------- API ------------------>

composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
php artisan migrate

https://laravel.com/docs/8.x/sanctum


    
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

--Register:
    * URL: http://127.0.0.1:8000/api/register
    * Method: POST
    * Request: ['name', 'email', 'password', 'password_confirmation']
    * Response:
        {
            "token": "6|zNDdqboXLAu72STrhA8x2lPL2WeAhtudBTTOiPgE",
            "status": true,
            "code": 200
        }

--Login:
    * URL: http://127.0.0.1:8000/api/login
    * Method: POST
    * Request: ['email', 'password']
    * Response:
        {
            "token": "7|Ec7ydJSYatWcUGAw9QB6uoYLv1156aAPnyEN53Su",
            "status": true,
            "code": 200,
            "message": "Logout successfully"
        }

--Logout:
    * URL: http://127.0.0.1:8000/api/v1/logout
    * Method: 
    * Request: ['token']
    * Response:
        {
            "message": "Logout successful",
            "status": true,
            "code": 200
        }


--Profile:
    * URL: http://127.0.0.1:8000/api/v1/profile
    * Method: GET
    * Request: ['token']
    * Response:
        {
            "id": 506,
            "name": "XV",
            "email": "winxu@test.com",
            "phone": null,
            "email_verified_at": null,
            "image": null,
            "created_at": "2021-09-02T05:35:20.000000Z",
            "updated_at": "2021-09-02T05:35:20.000000Z"
        }