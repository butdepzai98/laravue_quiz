<!------------------- API ------------------>

php artisan route:list

-------------------------
try {
    return response()->json([
        'status'    => true,
        'code'  => Response::HTTP_OK
    ]);
} catch (\Exception $e) {
    return response()->json([
        'status'    => false,
        'code'   => Response::HTTP_INTERNAL_SERVER_ERROR,
        'message'   => $e->getMessage()
    ]);
}
-------------------------

<!-- Controller Resource -->
php artisan make:controller Api/ExamController --resource

Resource API
MVCS: Model View Controller Service

Domain: http://127.0.0.1:8000/

- List exams (included pagination)
    * URl: api/v1/exams
    * Method: GET
    * Request: api/v1/exams?limit=2&page=3&column=id&sort=asc
    * Response:
        Success:
            {
                "status": true,
                "code": 200,
                "exams": [
                    {
                        "id": 5,
                        "name": "Deleniti consequatur qui qui quisquam.",
                        "created_at": "2021-08-17T18:18:32.000000Z",
                        "updated_at": "2021-08-17T18:18:32.000000Z"
                    },
                    .......................
                    .......................
                ],
                "meta": {
                    "total": 30,
                    "perPage": "2",
                    "currentPage": 3
                }
            }

        False:
            {
                "status": false,
                "bug": 500,
                "message": "Undefined variable: examsPaginates"
            }

- Create exams