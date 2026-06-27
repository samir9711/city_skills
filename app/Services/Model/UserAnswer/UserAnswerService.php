<?php

namespace App\Services\Model\UserAnswer;

use App\Services\Basic\BasicCrudService;
use App\Services\Basic\ModelColumnsService;
use App\Models\UserAnswer;
use App\Http\Resources\Model\UserAnswerResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserAnswerService extends BasicCrudService
{
    /**
     * Override to set up modelColumnsService and resource.
     */
    protected function setVariables(): void
    {
        $this->modelColumnsService = ModelColumnsService::getServiceFor(
            $this->model = UserAnswer::class
        );

        $this->resource = UserAnswerResource::class;
    }


    public function submitAnswers($request): array
    {
        $user = auth('user')->user();

        if (!$user) {
            throw new HttpResponseException(
                response()->json([
                    'message' => 'المستخدم غير مسجل الدخول'
                ], 401)
            );
        }

        $answers = $request->input('answers', []);

        if (empty($answers)) {
            throw new HttpResponseException(
                response()->json([
                    'message' => 'يرجى إرسال الإجابات'
                ], 422)
            );
        }

        DB::transaction(function () use ($answers, $user) {

            foreach ($answers as $answer) {

                UserAnswer::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'question_id' => $answer['question_id'],
                    ],
                    [
                        'question_option_id' => $answer['question_option_id'],
                    ]
                );
            }
        });

        return [
            'message' => 'تم حفظ إجابات الاستبيان بنجاح'
        ];
    }
}
