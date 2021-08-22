<!------------------- API ------------------>

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

--Question;
    * URL: 
    * Method: 
    * Request:
    * Response:

- --List Question
    * URL: api/v1/question
    * Method: Get
    * Request: ?limit=20&page=3&column=id&sort=asc
    * Response:
        "questions": [
            {
                "id": 5,
                "content": "Deleniti totam fugiat adipisci ducimus in vitae. Atque ratione quis consequatur modi omnis. Ratione earum modi dolorum possimus culpa magni. ?",
                "created_at": "2021-08-17T18:18:29.000000Z",
                "updated_at": "2021-08-17T18:18:29.000000Z"
            },
            {
                "id": 6,
                "content": "Vel esse eos autem nam vel explicabo magni. Aut vero culpa non delectus. Quis impedit aut tempora et. ?",
                "created_at": "2021-08-17T18:18:29.000000Z",
                "updated_at": "2021-08-17T18:18:29.000000Z"
            }
        ]


- --Show Detail Question
    * URL: api/v1/question/30
    * Method: Get
    * Request: {id}
    * Response:
        {
            "status": true,
            "code": 200,
            "question": {
                "id": 31,
                "content": "Sit qui saepe et provident. Quia libero eos assumenda iusto et consequatur sed. Nihil dicta eum voluptate modi error ratione. ?",
                "created_at": "2021-08-17T18:18:29.000000Z",
                "updated_at": "2021-08-17T18:18:29.000000Z",
                "answers": [
                    {
                        "id": 121,
                        "question_id": 31,
                        "content": "Accusantium aperiam est est sequi.",
                        "correct": 0,
                        "created_at": "2021-08-17T18:18:30.000000Z",
                        "updated_at": "2021-08-17T18:18:30.000000Z"
                    }
                    .............................
                    .............................
                ]
            }
        }

- --Create New Question
    * URI: api/v1/question
    * Method: POST
    * Request:
        {
            "content": "What about now 2 ?",
            "answers": [
                {
                    "content": "Non est doloremque ut libero et neque occaecati.",
                    "correct": 1
                }
                ...............
                ...............
            ]
        }

        Must be validation?
            - Content: require
            - Câu hỏi phải có tối thiểu là 2 câu trả lời
            - Nôi dung câu trả lời bắt buộc nhập
            - Một câu hỏi, chỉ có một câu trả lời đúng
            - Nội dung câu trả lời không được giống nhau
            - Phải có ít nhất 1 câu trả lời đúng
            - Nội dung câu hỏi không được nhỏ hơn 12 ký tự
            - Nội dung câu trả lời không được bỏ trống,
            - Nội dung câu trả lời không được nhỏ hơn 3 ký tự,
            - giá trị correct chỉ được phép là true hoặc false


    * Response:
        {
            "status": true,
            "code": 200,
            "question": {
                "content": "What about now 3 ?",
                "updated_at": "2021-08-22T10:59:49.000000Z",
                "created_at": "2021-08-22T10:59:49.000000Z",
                "id": 759,
                "answers": [
                    {
                        "id": 3025,
                        "question_id": 759,
                        "content": "Non est doloremque ut libero et neque occaecati.",
                        "correct": 1,
                        "created_at": "2021-08-22T10:59:49.000000Z",
                        "updated_at": "2021-08-22T10:59:49.000000Z"
                    },
                    ..............
                    ..............
                ]
            }
        }


- --Update Question by Id
    * URL: api/v1/question/600
    * Method: PUT
    * Request: {id}
        {
            "content": "Cumque minus et at dolores sit officia aliquid ?",
            "answers": [
                {
                    "id": 2397,
                    "question_id": 600,
                    "content": "Non est doloremque ut libero et neque occaecati.",
                    "correct": 0,
                    "created_at": "2021-08-17T18:18:32.000000Z",
                    "updated_at": "2021-08-17T18:18:32.000000Z"
                },
                .....................
                .....................
            ]
        }

    * Response:
        {
            "status": true,
            "code": 200,
            "answerRemoved": {
                "2": 3021,
                "3": 3022
            },
            "question": {
                "id": 600,
                "content": "Cumque minus et at dolores sit officia aliquid ?",
                "created_at": "2021-08-17T18:18:30.000000Z",
                "updated_at": "2021-08-22T10:48:06.000000Z",
                "answers": [
                    {
                        "id": 2397,
                        "question_id": 600,
                        "content": "Non est doloremque ut libero et neque occaecati.",
                        "correct": 0,
                        "created_at": "2021-08-17T18:18:32.000000Z",
                        "updated_at": "2021-08-22T10:49:15.000000Z"
                    },
                    ......................
                    ......................
                ]
            }
        }