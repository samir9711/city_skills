<?php

namespace App\Http\Resources\Model;

use App\Models\Skill;
use App\Models\SkillUser;
use Illuminate\Http\Request;
use App\Http\Resources\Basic\BasicResource;
use App\Services\Basic\ModelColumnsService;

class SkillResource extends BasicResource
{
    /**
     * إجمالي عدد الأصوات
     */
    public $totalVotes;

    public function __construct($resource, $totalVotes = null)
    {
        parent::__construct($resource);

        $this->totalVotes = $totalVotes;
    }

    public function setTotalVotes($totalVotes)
    {
        $this->totalVotes = $totalVotes;

        return $this;
    }

    public function toArray(Request $request): array
    {
        return $this->initResource(
            ModelColumnsService::getServiceFor(Skill::class)
        );
    }

    protected function initResource($modelColumnsService): array
    {
        $this->result = parent::initResource($modelColumnsService);

        // عدد الأصوات لهذه المهارة
        $votes = $this->users_count ?? 0;

        // إجمالي الأصوات
        $totalVotes = $this->totalVotes
            ?? $this->resource->totalVotes
            ?? SkillUser::count();

        $this->result['users_percentage'] = $totalVotes > 0
            ? round(($votes / $totalVotes) * 100, 2)
            : 0;

        return $this->result;
    }
}
