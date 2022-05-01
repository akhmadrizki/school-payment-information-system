<?php

namespace Database\Seeders;

use App\Models\Scholarship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ScholarshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Scholarship::insert([
            [
                'id' => 1,
                'name' => 'reguler',
            ],
            [
                'id' => 2,
                'name' => 'bidikmisi',
            ],
            [
                'id' => 3,
                'name' => 'prestasi',
            ],
        ]);
    }
}
