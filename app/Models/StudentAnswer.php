<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    use HasFactory;

    protected $cast = [
        'uqid' => 'char',
        'answers' => 'json',
        'status' => 'enum'
    ];
}
