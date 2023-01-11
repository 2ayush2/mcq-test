<?php

namespace App\Repositories;

use App\Http\Resources\QuestionListResource;
use App\Interfaces\CrudInterface;
use App\Jobs\SendMailJob;
use App\Models\QuestionList;
use App\Models\StudentAnswer;

class AnswerRepository
{

    public function saveTest($data)
    {
        $json = $data["answer"];
        $questionNumbers = [];
        $flag = true;
        foreach ($json as $qsn => $ans) {
            $questionNumbers[] = $qsn;
            
        }
    }
}
