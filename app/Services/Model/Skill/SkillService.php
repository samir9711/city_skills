<?php

namespace App\Services\Model\Skill;

use App\Services\Basic\BasicCrudService;
use App\Services\Basic\ModelColumnsService;
use App\Models\Skill;
use App\Models\User;
use App\Http\Resources\Model\SkillResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SkillService extends BasicCrudService
{
    protected $totalUsers; // لتخزين العدد الإجمالي للمستخدمين

    public function __construct()
    {
        parent::__construct();
        // حساب العدد الإجمالي للمستخدمين النشطين (غير المحذوفين) مرة واحدة
        $this->totalUsers = User::withoutTrashed()->count();
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
        $this->countRelations = ['users']; // سيتم تحميلها في show
    }

    /**
     * Override allQuery لإضافة withCount('users') لكل الاستعلامات
     */
    protected function allQuery(): object
    {
        return parent::allQuery()->withCount('users');
    }

    /**
     * Override pureAll لتمرير totalUsers إلى كل عنصر
     */
    public function pureAll(Request $request): mixed
    {
        $data = $this->allQuery()->get();
        return $this->resource::collection($data)->each(function ($item) {
            $item->setTotalUsers($this->totalUsers);
        });
    }

    /**
     * Override all لتمرير totalUsers إلى كل عنصر
     */
    public function all(Request $request): mixed
    {
        $data = $this->allQuery()->get();
        return $this->resource::collection($data)->each(function ($item) {
            $item->setTotalUsers($this->totalUsers);
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

        // تمرير totalUsers لكل عنصر في المجموعة قبل التحويل إلى Resource
        $data->getCollection()->transform(function ($item) {
            $item->totalUsers = $this->totalUsers; // نضعها مباشرة في النموذج
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

        return $this->resource::make($this->object)->setTotalUsers($this->totalUsers);
    }
}
