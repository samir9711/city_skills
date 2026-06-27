<?php

namespace App\Models;

use App\Models\BaseModel;

use Illuminate\Database\Eloquent\Model;

class QuestionOption extends BaseModel
{
    protected $fillable = [
        'question_id' => 'question_id',
        'option_text' => 'option_text',
    ];

    protected $casts = [
        'question_id' => 'integer',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    //
}
