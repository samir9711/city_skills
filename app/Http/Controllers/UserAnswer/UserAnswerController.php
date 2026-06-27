<?php

namespace App\Http\Controllers\UserAnswer;

use App\Facades\Services\UserAnswer\UserAnswerFacade;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FatherCrudController;
use App\Http\Requests\Model\StoreUserAnswerRequest;
use Illuminate\Http\Request;

class UserAnswerController extends FatherCrudController
{
    protected function setVariables() : void {
        $this->key = "user_answer";
        $this->service = UserAnswerFacade::class;
        $this->createRequest = StoreUserAnswerRequest::class;
        $this->updateRequest = StoreUserAnswerRequest::class;
    }

    public function submitAnswers(Request $request)
    {
        try {
            $data = $this->service::submitAnswers($request);
            return $this->apiResponse($data);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }
}
