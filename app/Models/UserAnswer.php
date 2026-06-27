<?php

namespace App\Models;

use App\Models\BaseModel;

use Illuminate\Database\Eloquent\Model;

class UserAnswer extends BaseModel
{
    protected $fillable = [
        'user_id' => 'user_id',
        'question_id' => 'question_id',
        'question_option_id' => 'question_option_id',
    ];

    protected $casts = [
        'user_id' => 'integer',
        'question_id' => 'integer',
        'question_option_id' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function option()
    {
        return $this->belongsTo(QuestionOption::class, 'question_option_id');
    }

    //
}
