<?php

namespace Database\Seeders;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::insert([
            [
                'nis' => '6381',
                'whatsapp' => '6281999015508',
                'whatsapp_parent' => '6281936060096',
                'is_active' => true,
                'user_id' => 3,
                'study_program_id' => 2,
                'scholarship_id' => 1,
                'grade_id' => 3,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'nis' => '9689',
                'whatsapp' => '62895394548780',
                'whatsapp_parent' => '6281936060096',
                'is_active' => true,
                'user_id' => 4,
                'study_program_id' => 2,
                'scholarship_id' => 3,
                'grade_id' => 2,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'nis' => '9575',
                'whatsapp' => '6281999015507',
                'whatsapp_parent' => '6281936060096',
                'is_active' => true,
                'user_id' => 5,
                'study_program_id' => 2,
                'scholarship_id' => 1,
                'grade_id' => 1,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'nis' => '9561',
                'whatsapp' => '6281999015308',
                'whatsapp_parent' => '6281936060096',
                'is_active' => true,
                'user_id' => 6,
                'study_program_id' => 2,
                'scholarship_id' => 1,
                'grade_id' => 3,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
            [
                'nis' => '9690',
                'whatsapp' => '6281238483464',
                'whatsapp_parent' => '6281936060096',
                'is_active' => true,
                'user_id' => 7,
                'study_program_id' => 1,
                'scholarship_id' => 2,
                'grade_id' => 3,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ],
        ]);
    }
}
