<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run(): void
    {
        $questions = [
            'هل تبحث عن فرصة تصنع فرقاً في حياتك؟',
            'هل تؤمن أن النجاح مهارة قبل أن يكون حظاً؟',
            'هل أنت مستعد لتطوير نفسك ومواكبة متطلبات المستقبل؟',
            'هل ترغب في زيادة فرص نجاحك في العمل أو الدراسة أو مشروعك الخاص؟',
            'هل أنت جاهز لتكون أحد سكان مدينة المهارات؟',
        ];

        foreach ($questions as $questionText) {
            $question = Question::create([
                'question' => $questionText,
                'is_active' => true,
            ]);

            $question->options()->createMany([
                [
                    'option_text' => 'نعم',
                ],
                [
                    'option_text' => 'لا',
                ],
            ]);
        }
    }
}
