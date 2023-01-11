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
}
