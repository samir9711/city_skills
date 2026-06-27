<?php

namespace App\Services\Model\QuestionOption;

use App\Services\Basic\BasicCrudService;
use App\Services\Basic\ModelColumnsService;
use App\Models\QuestionOption;
use App\Http\Resources\Model\QuestionOptionResource;

class QuestionOptionService extends BasicCrudService
{
    /**
     * Override to set up modelColumnsService and resource.
     */
    protected function setVariables(): void
    {
        $this->modelColumnsService = ModelColumnsService::getServiceFor(
            $this->model = QuestionOption::class
        );

        $this->resource = QuestionOptionResource::class;
    }
}