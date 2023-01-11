<?php

namespace App\Models;

use App\Scopes\ActiveScope;
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
        static::addGlobalScope(new ActiveScope);
    }

    const MAIL_STATUS_PENDING = 0;
    const MAIL_STATUS_COMPLETE = 1;
    const NUMBER_OF_RND_QUESTIONS = 5;

    protected $cast = [
        'expiry_date' => 'date',
        'mail_status' => 'enum'
    ];

    protected $fillable = [
        'title',
        'expiry_date'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    // protected $hidden = [];


}
