<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionBank extends Model
{
    use HasFactory;

    const TYPE_PHYSICS = 'p';
    const TYPE_CHEMISTRY = 'c';

    protected $cast = [
        'answer' => 'char',
        'options' => 'json',
        'type' => 'enum'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'answer',
    ];

    /**
     * getRandomFiveQuestion select 5 random question for given type 
     *
     * @param String $type QuestionBank::TYPE_PHYSICS or QuestionBank::TYPE_CHEMISTRY
     * @param int $rows Number of random rows to return
     * @return Array
     */
    public static function getRandomFiveQuestion(String $type, int $rows)
    {
        // SELECT * FROM question_banks WHERE type=$type AND expiry_date>=now() ORDER BY RAND() LIMIT 1;
        return QuestionBank::inRandomOrder()->select(['id'])->where('type', $type)->limit($rows)->get()->toArray();
    }
}
