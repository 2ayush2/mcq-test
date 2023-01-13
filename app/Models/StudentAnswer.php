<?php

namespace App\Models;

use App\Scopes\ActiveTestScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    use HasFactory;


    /*
    Applying active scope to get only unexpired QuestionList from model
    */
    protected static function boot()
    {
        parent::boot();
        // static::addGlobalScope(new ActiveTestScope);
    }
    protected $cast = [
        'answers' => 'json',
        'status' => 'enum'
    ];

    protected $fillable = [
        'answers',
        'status',
        'score'
    ];
    const STATUS_NOT_ATTEMPTED = 'p';
    const STATUS_ATTEMPTED = 'a';
    const STATUS_COMPLETED = 'c';

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

    /**
     * Get the Student associated with the current Answer.
     */
    public function student()
    {
        return $this->belongsTo(Student::class, "fk_student_id");
    }

    /**
     * Get the Question associated with the current Answer.
     */
    public function questionList()
    {
        return $this->belongsTo(QuestionList::class, "fk_question_id");
    }
}
