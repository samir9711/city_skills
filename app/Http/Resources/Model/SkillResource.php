<?php

namespace App\Http\Resources\Model;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Resources\Basic\BasicResource;
use App\Services\Basic\ModelColumnsService;

class SkillResource extends BasicResource
{
    public $totalUsers; // خاصية عامة لحمل العدد الإجمالي للمستخدمين

    public function __construct($resource, $totalUsers = null)
    {
        parent::__construct($resource);
        $this->totalUsers = $totalUsers;
    }

    // دالة مساعدة لتحديد totalUsers بعد الإنشاء
    public function setTotalUsers($totalUsers)
    {
        $this->totalUsers = $totalUsers;
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
        // بناء الأعمدة الأساسية
        $this->result = parent::initResource($modelColumnsService);

        // عدد المستخدمين لهذه المهارة (يجب أن يكون محملاً بـ withCount)
        $usersCount = $this->users_count ?? 0;

        // العدد الكلي للمستخدمين: إما من الخاصية أو حساب احتياطي
        $totalUsers = $this->totalUsers ?? \App\Models\User::withoutTrashed()->count();

        // حساب النسبة المئوية (برقمين عشريين)
        $this->result['users_percentage'] = $totalUsers > 0
            ? round(($usersCount / $totalUsers) * 100, 2)
            : 0;

        return $this->result;
    }
}
