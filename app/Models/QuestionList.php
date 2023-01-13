<?php

namespace App\Models;

use App\Scopes\ActiveQuestionScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionList extends Model
{

    use HasFactory;

    /*
    Applying active scope to get only unexpired QuestionList from model
    */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new ActiveQuestionScope);
    }

    const MAIL_STATUS_PENDING = 'p';
    const MAIL_STATUS_COMPLETE = 'c';
    const NUMBER_OF_RND_QUESTIONS = 5;

    protected $cast = [
        'expiry_date' => 'date',
        'mail_status' => 'enum'
    ];

    protected $fillable = [
        'title',
        'expiry_date',
        'mail_status'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [];


    /**
     * Get the Question associated with the current Questionaries.
     */
    public function questionBank()
    {
        return $this->hasMany(QsnToBank::class, "fk_bank_id");
    }
}
