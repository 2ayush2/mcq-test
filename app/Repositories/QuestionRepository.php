<?php

namespace App\Repositories;

use App\Http\Resources\QuestionListResource;
use App\Interfaces\CrudInterface;
use App\Jobs\SendMailJob;
use App\Models\QuestionList;
use App\Models\StudentAnswer;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class QuestionRepository implements CrudInterface
{

    /**
     * Get Question By Pages 
     *
     * 
     * @return collections Array of QuestionList Collection
     */
    public function getPaginatedData(int $perPage)
    {
        // $dd = QuestionList::orderBy('id', 'desc')
        //     // ->where("expiry_date", ">", "now()")
        //     ->where("expiry_date", ">=", date("Y-m-d"))
        //     ->paginate($perPage);
        // dd($dd);
        // die;
        return QuestionList::orderBy('id', 'desc')
            ->where("expiry_date", ">=", date("Y-m-d"))
            ->paginate($perPage);
        return QuestionListResource::collection(
            QuestionList::orderBy('id', 'desc')
                ->where("expiry_date", ">=", date("Y-m-d"))
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
        $newQuestion = QuestionList::create($data);
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
        if ($questionList['status'] != QuestionList::MAIL_STATUS_PENDING) {
            return false;
        }
        StudentAnswer::bulkInsert($questionList['id']);
        $data = StudentAnswer::join('student', 'student.id', '=', 'student_answers.fk_student_id')
            ->get(['student.name', 'student.email', 'student_answers.code']);
        dispatch(new SendMailJob($data));
        return true;
    }
}
