<?php

namespace App\Repositories;

use App\Http\Resources\TestQuestionsResource;
use App\Models\QsnToBank;
use App\Models\StudentAnswer;


class AnswerRepository
{
    public function getTest(StudentAnswer $studentAnswer)
    {
        if ($studentAnswer->status != StudentAnswer::STATUS_NOT_ATTEMPTED) {
            return null;
        }
        $studentAnswer->update(["status" => StudentAnswer::STATUS_ATTEMPTED]);
        $student = $studentAnswer->student;
        $questionList = QsnToBank::where("fk_qsn_id", $studentAnswer->fk_question_id)->with('question')->get();
        return [
            "id" => $studentAnswer->id,
            "code" => $studentAnswer->code,
            "title" => $studentAnswer->questionList->title,
            "student" => $student->name,
            "questions" => TestQuestionsResource::collection($questionList)
        ];
    }
    public function saveTest($data): bool
    {
        $studentAnswer = StudentAnswer::where("code", $data["code"])
            ->where("status", StudentAnswer::STATUS_NOT_ATTEMPTED)
            ->first();
        if (empty($studentAnswer)) {
            return false;
        }
        $json = $data["answers"];
        $questionNumbers = [];
        $flag = true;
        foreach ($json as $qsn => $ans) {
            $questionNumbers[] = $qsn;
            //check if answer value has more than 1 char ie A or B or C and soon
            if (strlen($ans) > 1) {
                $flag = false;
                break;
            }
        }
        //check if answer are correct
        if (!$flag) {
            return false;
        }
        //check if question number for given test code exist for 10 questions
        $count = QsnToBank::where('fk_qsn_id', $studentAnswer->fk_question_id)
            ->whereIn('fk_bank_id', $questionNumbers)->count();
        if ($count != 10) {
            return false;
        }
        $studentAnswer->update([
            "answers" => $data['answers'],
            "status" => StudentAnswer::STATUS_COMPLETED
        ]);
        return true;
    }
}
