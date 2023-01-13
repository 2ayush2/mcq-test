#About MCQ
This project is `PHP-Advance`

To use this application please follow the steps:
- Create database 'mcqtest'
- Edit .env file as per your environment 
- Set your env file for `QUEUE_CONNECTION=database`
- Enter into the project directory
- Run command `composer install` to run migration
- Run command `php artisan migrate` to run migration
- Run command `php artisan db:seed` to run seed
- Run command `php artisan serve` to start you server


This project has two portal ie for admin and for student.

Admin :
    Admin user can access to this application from [http://localhost:8000/admin](http://localhost:8000/admin)
    please configure your host and ports accordingly. Use default user and password for login ie: email 'test@gmail.com' and password 'admin12345'.
    You can view list of question of first page. and create new questions from create button.
    Once created, you can send email to student by clicking email icon

Student :
    Once email are send, student will receive link to the test. 
    Student can visit the link to attent test. Once all test are attempted student can submit it.
    Link are not valid once test is complete.
    The sample url for student is [http://localhost:8000/student/test/34526eb5-92c1-11ed-b160-60e32bd514d9](http://localhost:8000/student/test/34526eb5-92c1-11ed-b160-60e32bd514d9)
    `34526eb5-92c1-11ed-b160-60e32bd514d9` code can vary depending to student

Enjoy using application