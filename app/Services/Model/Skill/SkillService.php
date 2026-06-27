<?php

namespace App\Services\Model\Skill;

use App\Http\Resources\Model\SkillResource;
use App\Models\Skill;
use App\Models\User;
use App\Services\Basic\BasicCrudService;
use App\Services\Basic\ModelColumnsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SkillService extends BasicCrudService
{
    protected array $skillPercentages = [];

    protected function setVariables(): void
    {
        $this->modelColumnsService = ModelColumnsService::getServiceFor(
            $this->model = Skill::class
        );

        $this->resource = SkillResource::class;

        $this->countRelations = ['users'];
    }

    /**
     * حساب النسب الحقيقية بحيث يكون مجموعها 100%
     */
    protected function calculatePercentages(): void
    {
        $weights = DB::table('skill_users as su')
            ->join(
                DB::raw('(
                    SELECT user_id, COUNT(*) as total_skills
                    FROM skill_users
                    GROUP BY user_id
                ) as c'),
                'su.user_id',
                '=',
                'c.user_id'
            )
            ->selectRaw('su.skill_id, SUM(1 / c.total_skills) as score')
            ->groupBy('su.skill_id')
            ->pluck('score', 'skill_id');

        $totalScore = $weights->sum();

        foreach ($weights as $skillId => $score) {
            $this->skillPercentages[$skillId] = $totalScore > 0
                ? round(($score / $totalScore) * 100, 2)
                : 0;
        }
    }

    protected function allQuery(): object
    {
        return parent::allQuery()->withCount('users');
    }

    public function all(Request $request): mixed
    {
        $this->calculatePercentages();

        $data = $this->allQuery()->get();

        $data->transform(function ($skill) {
            $skill->users_percentage =
                $this->skillPercentages[$skill->id] ?? 0;

            return $skill;
        });

        return $this->resource::collection($data);
    }

    public function pureAll(Request $request): mixed
    {
        return $this->all($request);
    }

    public function allPaginated(Request $request): mixed
    {
        $this->calculatePercentages();

        $data = $this->allQuery()->paginate(
            $request->input('per_page', 10),
            ['*'],
            'page',
            $request->input('page', 1)
        );

        $data->getCollection()->transform(function ($skill) {
            $skill->users_percentage =
                $this->skillPercentages[$skill->id] ?? 0;

            return $skill;
        });

        return [
            Str::plural(strtolower(class_basename($this->model))) => $this->resource::collection($data),
            'current_page' => $data->currentPage(),
            'next_page' => $data->nextPageUrl(),
            'previous_page' => $data->previousPageUrl(),
            'total_pages' => $data->lastPage(),
        ];
    }

    public function show(Request $request): mixed
    {
        $this->calculatePercentages();

        $this->object = $this->model::with($this->relations)
            ->withTrashed()
            ->withCount($this->countRelations)
            ->findOrFail($request->id);

        $this->object->users_percentage =
            $this->skillPercentages[$this->object->id] ?? 0;

        return $this->resource::make($this->object);
    }
}
