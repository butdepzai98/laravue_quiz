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
            "exam": {
                "id": 32,
                "name": "Exam Covid-20",
                "updated_at": "2020-03-29T14:21:16.000000Z",
                "created_at": "2020-03-29T14:21:16.000000Z"
            }
        }
