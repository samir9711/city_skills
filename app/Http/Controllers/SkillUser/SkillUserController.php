<?php

namespace App\Http\Controllers\SkillUser;

use App\Facades\Services\SkillUser\SkillUserFacade;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FatherCrudController;
use App\Http\Requests\Model\StoreSkillUserRequest;
use Illuminate\Http\Request;

class SkillUserController extends FatherCrudController
{
    protected function setVariables() : void {
        $this->key = "skill_user";
        $this->service = SkillUserFacade::class;
        $this->createRequest = StoreSkillUserRequest::class;
        $this->updateRequest = StoreSkillUserRequest::class;
    }

    public function deleteSkills(Request $request)
    {
        try {
            $data = $this->service::deleteSkills($request);
            return $this->apiResponse($data);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }
    public function storeSkills(Request $request)
    {
        try {
            $data = $this->service::storeSkills($request);
            return $this->apiResponse($data);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }
}
