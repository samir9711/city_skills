<?php

namespace App\Http\Controllers\QuestionOption;

use App\Facades\Services\QuestionOption\QuestionOptionFacade;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FatherCrudController;
use App\Http\Requests\Model\StoreQuestionOptionRequest;
use Illuminate\Http\Request;

class QuestionOptionController extends FatherCrudController
{
    protected function setVariables() : void {
        $this->key = "question_option";
        $this->service = QuestionOptionFacade::class;
        $this->createRequest = StoreQuestionOptionRequest::class;
        $this->updateRequest = StoreQuestionOptionRequest::class;
    }
}