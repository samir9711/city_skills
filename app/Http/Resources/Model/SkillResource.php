<?php

namespace App\Http\Resources\Model;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Resources\Basic\BasicResource;
use App\Services\Basic\ModelColumnsService;

class SkillResource extends BasicResource
{
    public function toArray(Request $request): array
    {
        return $this->initResource(
            ModelColumnsService::getServiceFor(Skill::class)
        );
    }

    protected function initResource($modelColumnsService): array
    {
        $this->result = parent::initResource($modelColumnsService);

        $this->result['users_percentage'] =
            round($this->users_percentage ?? 0, 2);

        return $this->result;
    }
}
