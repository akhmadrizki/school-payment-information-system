<?php

namespace Database\Seeders;

use App\Models\StudyProgram;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudyProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StudyProgram::insert([
            [
                'id' => 1,
                'name' => 'Akomodasi Perhotelan',
            ],
            [
                'id' => 2,
                'name' => 'Multimedia',
            ],
            [
                'id' => 3,
                'name' => 'Tata Boga',
            ],
            [
                'id' => 4,
                'name' => 'Tata Niaga',
            ],
        ]);
    }
}
