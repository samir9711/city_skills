<?php

namespace App\Models;

use App\Models\BaseModel;

use Illuminate\Database\Eloquent\Model;

class Question extends BaseModel
{
    protected $fillable = [
        'question' => 'question',
        'is_active' => 'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function options()
    {
        return $this->hasMany(QuestionOption::class);
    }

    public function answers()
    {
        return $this->hasMany(UserAnswer::class);
    }

    //
}
