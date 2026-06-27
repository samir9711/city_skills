<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            'تسويق وإدارة مشاريع',
            'تصميم',
            'تصوير',
            'برمجة',
            'التواصل والإقناع',
            'القيادة وإدارة الفرق',
            'صناعة المحتوى الرقمي',
            'الذكاء الاصطناعي',
            'التفكير النقدي وحل المشكلات',
        ];

        foreach ($skills as $skill) {
            Skill::firstOrCreate([
                'name' => $skill,
            ]);
        }
    }
}
