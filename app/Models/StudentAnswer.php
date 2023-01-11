<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    use HasFactory;

    protected $cast = [
        'answers' => 'json',
        'status' => 'enum'
    ];

    const STATUS_NOT_ATTEMPTED = 0;
    const STATUS_ATTEMPTED = 1;
    const STATUS_COMPLETED = 2;

    /**
     * Bulk insert into StudentAnswer
     * 
     * @param int id from App\Models\QuestionList
     * @return bool
     */
    public static function bulkInsert(int $questionid)
    {
        $studentList = Student::get()->toArray();
        $dataList = [];
        foreach ($studentList as $sl) {
            $dataList[] = [
                "fk_student_id" => $sl["id"],
                "fk_question_id" => $questionid
            ];
        }
        return StudentAnswer::insert($dataList);
    }
}
