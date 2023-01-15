<?php

namespace Tests\Unit;

use App\Jobs\SendMailJob;
use App\Models\QsnToBank;
use App\Models\QuestionList;
use App\Repositories\QuestionRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AnswerRepositoryTest extends TestCase
{
    use WithFaker;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_if_store_works()
    {
        //Goal : make sure we can create new questions

        $questionRepository = $this->app->make(QuestionRepository::class);
        $data = [
            'title' => $this->faker->name(),
            'expiry_date' => $this->faker->date()
        ];
        $result = $questionRepository->create($data);
        //check if data is created
        $this->assertSame($data['title'], $result->title, 'Question created does not have the same title.');

        $count = QsnToBank::query()->where(["fk_qsn_id" => $result->id])->count();
        //check random question are created
        $this->assertSame(QuestionList::NUMBER_OF_RND_QUESTIONS * 2, $count);
    }

    public function test_if_send_mail_works()
    {
        //Goal : make sure we can create new questions
        // $questionRepository = $this->createMock(QuestionRepository::class);
        $questionRepository = new QuestionRepository();
        $questionList = QuestionList::factory()->create([
            'title' => $this->faker->name(),
            'expiry_date' => $this->faker->date(),
            'mail_status' => QuestionList::MAIL_STATUS_PENDING
        ]);

        Mail::shouldReceive("to")->andReturnUsing(function ($mail) {

            
        });


        $result = $questionRepository->sendMail($questionList);
        dd($result, 'hello');
        $this->assertTrue($result);
    }

    public function test_if_get_question_list_works()
    {
        //Goal : make sure we can create new questions
        $questionRepository = $this->app->make(QuestionRepository::class);
        // $questionList = QuestionList::factory(2)->create([
        //     'title' => $this->faker->name(),
        //     'expiry_date' => $this->faker->date()
        // ]);

        // $result = $questionRepository->getPaginatedData(20);

        // dd($result);
        //check if data is created
        // $this->assertTrue($result);
        // $this->assertSame(QuestionList::MAIL_STATUS_COMPLETE, $result->mail_status, 'Question mail not sent to student');
    }
}
