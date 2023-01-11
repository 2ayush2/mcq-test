<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionList extends Model
{

    use HasFactory;

    const MAIL_STATUS_PENDING = 0;
    const MAIL_STATUS_COMPLETE = 1;

    protected $cast = [
        'expiry_date' => 'date',
        'mail_status' => 'enum'
    ];
}
