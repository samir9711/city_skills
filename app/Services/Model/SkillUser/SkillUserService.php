<?php

namespace App\Services\Model\SkillUser;

use App\Services\Basic\BasicCrudService;
use App\Services\Basic\ModelColumnsService;
use App\Models\SkillUser;
use App\Http\Resources\Model\SkillUserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Exceptions\HttpResponseException;

class SkillUserService extends BasicCrudService
{
    /**
     * Override to set up modelColumnsService and resource.
     */
    protected function setVariables(): void
    {
        $this->modelColumnsService = ModelColumnsService::getServiceFor(
            $this->model = SkillUser::class
        );

        $this->resource = SkillUserResource::class;
    }

    public function storeSkills(Request $request): array
    {
        $user = auth('user')->user();

        if (!$user) {
            throw new HttpResponseException(
                response()->json([
                    'message' => 'المستخدم غير مسجل الدخول'
                ], 401)
            );
        }

        $skillIds = $request->input('skill_ids', []);

        if (empty($skillIds)) {
            throw new HttpResponseException(
                response()->json([
                    'message' => 'يرجى اختيار مهارة واحدة على الأقل'
                ], 422)
            );
        }

        DB::transaction(function () use ($user, $skillIds) {

            foreach (array_unique($skillIds) as $skillId) {

                SkillUser::firstOrCreate([
                    'user_id' => $user->id,
                    'skill_id' => $skillId,
                ]);
            }

        });

        return [
            'message' => 'تم حفظ المهارات بنجاح'
        ];
    }

    public function deleteSkills(Request $request): array
    {
        $user = auth('user')->user();

        if (!$user) {
            throw new HttpResponseException(
                response()->json([
                    'message' => 'المستخدم غير مسجل الدخول'
                ], 401)
            );
        }

        $skillIds = $request->input('skill_ids', []);

        if (empty($skillIds)) {
            throw new HttpResponseException(
                response()->json([
                    'message' => 'يرجى تحديد المهارات المراد حذفها'
                ], 422)
            );
        }

        SkillUser::where('user_id', $user->id)
            ->whereIn('skill_id', $skillIds)
            ->delete();

        return [
            'message' => 'تم حذف المهارات بنجاح'
        ];
    }
}
