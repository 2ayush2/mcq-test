<?php

namespace App\Repositories;

use App\Http\Resources\QuestionListResource;
use App\Interfaces\CrudInterface;
use App\Jobs\SendMailJob;
use App\Models\QsnToBank;
use App\Models\QuestionList;
use App\Models\StudentAnswer;

class AnswerRepository
{

    public function saveTest($data): bool
    {
        $json = $data["answer"];
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
        $count = QsnToBank::where('code', $data['code'])->whereIn('fk_question_id', $questionNumbers)->count();
        if ($count != 10) {
            return false;
        }
        
    }
}
