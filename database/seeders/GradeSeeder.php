<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Grade::insert([
            [
                'id' => 1,
                'name' => 'X',
            ],
            [
                'id' => 2,
                'name' => 'XI',
            ],
            [
                'id' => 3,
                'name' => 'XII',
            ],
        ]);
    }
}
