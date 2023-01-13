<?php

namespace App\Repositories;

use App\Http\Resources\QuestionListResource;
use App\Interfaces\CrudInterface;
use App\Jobs\SendMailJob;
use App\Models\QsnToBank;
use App\Models\QuestionBank;
use App\Models\QuestionList;
use App\Models\StudentAnswer;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class QuestionRepository implements CrudInterface
{

    /**
     * Get Question By Pages 
     *
     * 
     * @return collections Array of QuestionList Collection
     */
    public function getPaginatedData(int $perPage): AnonymousResourceCollection
    {
        // return QuestionList::orderBy('id', 'desc')
        //     ->paginate($perPage);
        return QuestionListResource::collection(
            QuestionList::orderBy('id', 'desc')
                ->paginate($perPage)
        );
    }

    /**
     * Create New Question.
     *
     * @param array $data
     * @return object QuestionList Object
     */
    public function create(array $data): QuestionListResource
    {
        $newQuestion = DB::transaction(function () use ($data) {
            $newQuestion = QuestionList::create($data);
            $chemistry = QuestionBank::getRandomFiveQuestion(QuestionBank::TYPE_CHEMISTRY, QuestionList::NUMBER_OF_RND_QUESTIONS);
            $physics = QuestionBank::getRandomFiveQuestion(QuestionBank::TYPE_PHYSICS, QuestionList::NUMBER_OF_RND_QUESTIONS);
            $questionsList = array_merge(array_column($chemistry, "id"), array_column($physics, "id"));
            // $questionsList = array_merge(array_pluck($chemistry, "id"), array_pluck($physics, "id"));
            $qsnToBank = [];
            foreach ($questionsList as $qlist) {
                $qsnToBank[] = [
                    "fk_qsn_id" => $newQuestion["id"],
                    "fk_bank_id" => $qlist
                ];
            }
            QsnToBank::insert($qsnToBank);
            return $newQuestion;
        });
        return new QuestionListResource($newQuestion);
    }

    /**
     * Delete Question.
     *
     * @param int $id
     * @return boolean true if deleted otherwise false
     */
    public function delete(int $id): bool
    {
        $question = QuestionList::find($id);
        if (empty($question)) {
            return false;
        }
        $question->delete();
        return true;
    }

    /**
     * Get QuestionList Detail By ID.
     *
     * @param int $id
     * @return QuestionListResource
     */
    public function getByID(int $id): QuestionListResource
    {
        $question = QuestionList::find($id);
        if (empty($question)) {
            return null;
        }
        return new QuestionListResource(QuestionList::find($id));
    }

    /**
     * Update QuestionList By ID.
     *
     * @param int $id
     * @param array $data
     * @return object Updated QuestionListResource
     */
    public function update(int $id, array $data): QuestionListResource
    {
        $question = QuestionList::find($id);
        if (empty($question)) {
            return null;
        }
        $question->update($data);
        return new QuestionListResource($question);
    }

    /**
     * Send email to the student.
     *
     * @param int $id
     * @param array $data
     * @return boolean true if mail queued else false
     */
    public function sendMail(QuestionList $questionList): bool
    {
        if ($questionList['mail_status'] != QuestionList::MAIL_STATUS_PENDING) {
            return false;
        }

        StudentAnswer::bulkInsert($questionList['id']);
        $data = StudentAnswer::select(['students.name', 'students.email', 'student_answers.code'])
            ->join('students', 'students.id', '=', 'student_answers.fk_student_id')
            ->get()->toArray();
        // Mail::to($data[0]["email"])
        //     ->send(new StudentMail($data[0]));
        // dispatch(new SendMailJob($data))->delay(now());
        dispatch(new SendMailJob($data))->delay(now()->addSeconds(30));
        $ststus = $questionList->update([
            "mail_status" => QuestionList::MAIL_STATUS_COMPLETE
        ]);
        return true;
    }
}
