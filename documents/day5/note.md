<!-------- FACTORY --------->
Tao ra Sample Data

php artisan make:factory UserTableFactory --model=User

VD:
    -in database\seeders\UserTableSeeder.php

        public function run()
        {
            User::factory()->count(500)->create();
        }
-----
    -in database\seeders\DatabaseSeeder.php

        public function run()
        {
            // $this->call([
            //     UserTableSeeder::class,
            //     QuestionTableSeeder::class
            // ]);
            $this->call(QuestionTableSeeder::class);
        }




<!-- -------- -->
- User  (500)

- Questions
    -> Answers

- Exams

- Assign Question -> Exam   (
    + 1 de - 25 cau hoi
    + 1 đề ko đc phép có 2 câu hỏi giống nhau -> lam cho id tang dan)

- Results