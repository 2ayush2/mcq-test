<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QsnToBank extends Model
{
    use HasFactory;

    /**
     * Get the Question associated with the current Answer.
     */
    public function question()
    {
        return $this->belongsTo(QuestionBank::class, "fk_bank_id");
    }
}
