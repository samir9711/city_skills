<?php

namespace App\Http\Resources\Model;

use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Basic\BasicResource;
use App\Services\Basic\ModelColumnsService;

class QuestionResource extends BasicResource
{
    public function toArray(Request $request): array
    {
        $data = $this->initResource(
            ModelColumnsService::getServiceFor(
                Question::class
            )
        );
        $data['options'] = $this->whenLoaded('options', function () {
            return $this->options ? $this->options->toArray() : null;
        });

        return $data;
    }

    protected function initResource($modelColumnsService): array
    {
        $this->result = parent::initResource($modelColumnsService);

        return array_merge($this->result, []);
    }
}
