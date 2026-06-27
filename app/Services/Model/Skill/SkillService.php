<?php

namespace App\Services\Model\Skill;

use App\Services\Basic\BasicCrudService;
use App\Services\Basic\ModelColumnsService;
use App\Models\Skill;
use App\Models\SkillUser;
use App\Http\Resources\Model\SkillResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SkillService extends BasicCrudService
{
    /**
     * إجمالي عدد الأصوات (عدد السجلات في skill_users)
     */
    protected int $totalVotes;

    public function __construct()
    {
        parent::__construct();

        $this->totalVotes = SkillUser::count();
    }

    /**
     * Override setVariables لإضافة countRelations وضبط modelColumnsService
     */
    protected function setVariables(): void
    {
        $this->modelColumnsService = ModelColumnsService::getServiceFor(
            $this->model = Skill::class
        );

        $this->resource = SkillResource::class;

        $this->countRelations = ['users'];
    }

    /**
     * Override allQuery لإضافة withCount('users') لكل الاستعلامات
     */
    protected function allQuery(): object
    {
        return parent::allQuery()->withCount('users');
    }

    public function pureAll(Request $request): mixed
    {
        $data = $this->allQuery()->get();

        return $this->resource::collection($data)->each(function ($item) {
            $item->setTotalVotes($this->totalVotes);
        });
    }

    /**
     * Override all لتمرير totalUsers إلى كل عنصر
     */
    public function all(Request $request): mixed
    {
        $data = $this->allQuery()->get();

        return $this->resource::collection($data)->each(function ($item) {
            $item->setTotalVotes($this->totalVotes);
        });
    }

    /**
     * Override allPaginated لتمرير totalUsers إلى كل عنصر في الصفحة
     */
    public function allPaginated(Request $request): mixed
    {
        $data = $this->allQuery()->paginate(
            $request->input('per_page', 10),
            ['*'],
            'page',
            $request->input('page', 1)
        );

        $data->getCollection()->transform(function ($item) {
            $item->totalVotes = $this->totalVotes;

            return $item;
        });

        return [
            Str::plural(strtolower(class_basename($this->model))) => $this->resource::collection($data),
            'current_page' => $data->currentPage(),
            'next_page' => $data->nextPageUrl(),
            'previous_page' => $data->previousPageUrl(),
            'total_pages' => $data->lastPage(),
        ];
    }

    /**
     * Override show لتمرير totalUsers إلى Resource
     */
    public function show(Request $request): mixed
    {
        $this->object = $this->model::with($this->relations)
            ->withTrashed()
            ->withCount($this->countRelations)
            ->findOrFail($request->id);

        return $this->resource::make($this->object)
            ->setTotalVotes($this->totalVotes);
    }
}
