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
        'errors'    => [
            'status'    => false,
            'code'      => Response::HTTP_INTERNAL_SERVER_ERROR,
            'message'   => $e->getMessage(),
        ]
    ]);
}
-------------------------

<!-- Controller Resource -->
php artisan make:controller Api/ExamController --resource

Resource API
MVCS: Model View Controller Service

Domain: http://127.0.0.1:8000/

- --List exams (included pagination)
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

- --Create exams
    * URL: api/v1/exams/
    * Method: Post
    * Request:
        {
            "name": "Exam Exam Test",
            "questions":[
                {"question_id": 10 },
                {"question_id": 1 },
                {"question_id": 5 },
                {"question_id": 5 },
                {"question_id": 1 }
            ]
        }
    * Response:
        {
            "status": true,
            "code": 200,
            "exam": {
                "name": "Exam Exam Test",
                "updated_at": "2021-08-22T18:28:29.000000Z",
                "created_at": "2021-08-22T18:28:29.000000Z",
                "id": 43,
                "questions": [
                    {
                        "id": 1,
                        "content": "Rerum fugiat voluptatum sapiente quis non necessitatibus. Et quos in accusantium unde et. Accusamus deserunt dolorum sit odit optio in. ?",
                        "created_at": "2021-08-17T18:18:29.000000Z",
                        "updated_at": "2021-08-17T18:18:29.000000Z",
                        "pivot": {
                            "exam_id": 43,
                            "question_id": 1
                        }
                    },
                    .......................
                    .......................
                ]
            }
        }
    * Fail:
        {
            "status": false,
            "code": 500,
            "message": "SQLSTATE[HY000] [2002] No connection could be made because the target machine actively refused it.\r\n (SQL: select * from `exams` where (`id` is null) limit 1)"
        }

- --Update Exam:
    * Url: api/v1/exams/30
    * Method: PUT
    * Request:
    * Assign Question To Exam:
        {
            "name": "Exam Exam Test",
            "questions":[
                {"question_id": 10 },
                {"question_id": 1 },
                {"question_id": 5 },
                {"question_id": 5 },
                {"question_id": 1 }
            ]
        }
    * Response:
        {
            "status": true,
            "code": 200,
            "exam": {
                "name": "Exam Exam Test",
                "updated_at": "2021-08-22T18:28:29.000000Z",
                "created_at": "2021-08-22T18:28:29.000000Z",
                "id": 43,
                "questions": [
                    {
                        "id": 1,
                        "content": "Rerum fugiat voluptatum sapiente quis non necessitatibus. Et quos in accusantium unde et. Accusamus deserunt dolorum sit odit optio in. ?",
                        "created_at": "2021-08-17T18:18:29.000000Z",
                        "updated_at": "2021-08-17T18:18:29.000000Z",
                        "pivot": {
                            "exam_id": 43,
                            "question_id": 1
                        }
                    },
                    .......................
                    .......................
                ]
            }
        }
    

- --Show Exam:
    * URL: api/v1/exams/30
    * Method: Get
    * Request: {id}
    * Response: 
        {
            "status": true,
            "code": 200,
            "exam": {
                "id": 30,
                "name": "Exam created by Vinh",
                "created_at": "2021-08-17T18:18:32.000000Z",
                "updated_at": "2021-08-20T19:32:49.000000Z"
            }
        }


- --Delete Exam:
    * URL: api/v1/exams/32
    * Method: Delete
    * Response: 
        {
            "status": true,
            "code": 200
        }


<!-- -------- Assign Question To Exams ------------ -->